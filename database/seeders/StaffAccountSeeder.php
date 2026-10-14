<?php

namespace Database\Seeders;

use App\Models\Guru;
use App\Models\GuruBk;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
use RuntimeException;

class StaffAccountSeeder extends Seeder
{
    /**
     * @var array<string, array{username: string, name: string, email: string, role: string}>
     */
    private const ACCOUNTS = [
        'admin' => [
            'username' => 'admin',
            'name' => 'Admin',
            'email' => 'admin@kesiswaan.local',
            'role' => 'admin',
        ],
        'guru' => [
            'username' => 'guru',
            'name' => 'Guru',
            'email' => 'guru@kesiswaan.local',
            'role' => 'guru',
        ],
        'guru_bk' => [
            'username' => 'guru_bk',
            'name' => 'Guru BK',
            'email' => 'bk@kesiswaan.local',
            'role' => 'guru_bk',
        ],
    ];

    /**
     * Seed idempotent staff accounts and the teacher profiles required for login.
     */
    public function run(): void
    {
        $initialPassword = config('kesiswaan.initial_account_password');

        if (! is_string($initialPassword) || $initialPassword === '') {
            throw new RuntimeException('Set KESISWAAN_INITIAL_ACCOUNT_PASSWORD in .env before seeding staff accounts.');
        }

        foreach (['username', 'nama', 'email', 'password', 'role', 'status_aktif'] as $column) {
            if (! Schema::hasColumn('user', $column)) {
                throw new RuntimeException("The user.{$column} column is required before seeding staff accounts.");
            }
        }

        foreach (['id_user', 'no_guru', 'nama_guru', 'jenis_kelamin', 'email'] as $column) {
            if (! Schema::hasColumn('guru', $column)) {
                throw new RuntimeException("The guru.{$column} column is required before seeding staff accounts.");
            }
        }

        DB::transaction(function () use ($initialPassword): void {
            $this->validateAccountIdentifiers();

            $accounts = [];

            foreach (self::ACCOUNTS as $key => $attributes) {
                $accounts[$key] = User::query()->updateOrCreate(
                    ['email' => $attributes['email']],
                    [
                        'username' => $attributes['username'],
                        'nama' => $attributes['name'],
                        'password' => Hash::make($initialPassword),
                        'role' => $attributes['role'],
                        'status_aktif' => true,
                    ],
                );
            }

            $teacherProfiles = [];

            foreach (['guru', 'guru_bk'] as $key) {
                $teacherProfiles[$key] = $this->ensureTeacherProfile($accounts[$key]);
            }

            GuruBk::query()->updateOrCreate(
                ['id_guru' => $teacherProfiles['guru_bk']->id_guru],
                ['status_aktif' => true],
            );
        });
    }

    private function validateAccountIdentifiers(): void
    {
        foreach (self::ACCOUNTS as $attributes) {
            $account = User::query()->where('email', $attributes['email'])->first();
            $usernameOwner = User::query()->where('username', $attributes['username'])->first();

            if ($usernameOwner && (! $account || $usernameOwner->isNot($account))) {
                throw new RuntimeException(
                    "The username {$attributes['username']} is already used by a different account.",
                );
            }

            if ($account?->siswa()->exists()) {
                throw new RuntimeException(
                    "The staff email {$attributes['email']} is already linked to a student profile.",
                );
            }
        }
    }

    private function ensureTeacherProfile(User $account): Guru
    {
        $profiles = Guru::query()
            ->where(function ($query) use ($account): void {
                $query->where('id_user', $account->id_user)
                    ->orWhere('email', $account->email);
            })
            ->get();

        if ($profiles->count() > 1) {
            throw new RuntimeException("Multiple teacher profiles match {$account->email}.");
        }

        $profile = $profiles->first();

        if ($profile && $profile->id_user !== null && (int) $profile->id_user !== (int) $account->id_user) {
            throw new RuntimeException("The teacher profile for {$account->email} is linked to a different account.");
        }

        if ($profile) {
            if ($account->role === 'guru' && $profile->guruBk()->where('status_aktif', true)->exists()) {
                throw new RuntimeException('The regular teacher account is linked to an active Guru BK profile.');
            }

            if ($profile->id_user === null) {
                $profile->user()->associate($account);
                $profile->save();
            }

            return $profile;
        }

        $teacherNumber = $this->nextTeacherNumber();

        return $account->guru()->create([
            'no_guru' => $teacherNumber,
            'nama_guru' => $account->nama,
            'jenis_kelamin' => 'L',
            'email' => $account->email,
        ]);
    }

    private function nextTeacherNumber(): string
    {
        $usedNumbers = Guru::query()->pluck('no_guru')->all();

        for ($number = 1; $number <= 999999; $number++) {
            $formattedNumber = str_pad((string) $number, 6, '0', STR_PAD_LEFT);

            if (! in_array($formattedNumber, $usedNumbers, true)) {
                return $formattedNumber;
            }
        }

        throw new RuntimeException('No available six-digit teacher number remains.');
    }
}
