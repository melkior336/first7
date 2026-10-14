<?php

namespace Tests\Feature\Database\Seeders;

use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\User;
use Database\Seeders\UserSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class UserSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_database_seeder_creates_and_links_all_student_accounts_for_email_login(): void
    {
        config()->set('kesiswaan.initial_account_password', 'test-staff-password');
        config()->set('kesiswaan.initial_student_password', 'Siswa@2026');
        $this->createStudentProfiles();

        $this->seed();

        $this->assertDatabaseCount('user', 39);
        $this->assertDatabaseHas('user', [
            'username' => 'maraville',
            'nama' => 'Andhika Maraville Gazelle',
            'email' => 'maraville@Kesiswaan.id',
            'role' => 'siswa',
            'status_aktif' => true,
        ]);
        $this->assertDatabaseHas('user', [
            'email' => 'admin@kesiswaan.local',
            'role' => 'admin',
        ]);

        $account = User::query()->where('email', 'maraville@Kesiswaan.id')->firstOrFail();
        $this->assertTrue(Hash::check('Siswa@2026', $account->password));
        $this->assertSame('Andhika Maraville Gazelle', $account->siswa->nama_siswa);
        $this->assertTrue(Hash::check(
            'test-staff-password',
            User::query()->where('email', 'admin@kesiswaan.local')->firstOrFail()->password,
        ));

        $this->post(route('login.post'), [
            'email' => 'maraville@Kesiswaan.id',
            'password' => 'Siswa@2026',
        ])->assertRedirect(route('dashboard.siswa'));

        $this->assertAuthenticatedAs($account);
        $this->get(route('dashboard.siswa'))
            ->assertOk()
            ->assertSee('Andhika Maraville Gazelle');
    }

    public function test_reseeding_resets_student_passwords_without_changing_profiles_or_other_roles(): void
    {
        config()->set('kesiswaan.initial_student_password', 'Siswa@2026');
        $this->createStudentProfiles();

        $this->seed(UserSeeder::class);

        $account = User::query()->where('email', 'maraville@Kesiswaan.id')->firstOrFail();
        $profile = $account->siswa;
        $profileDetails = $profile->only(['id_siswa', 'id_user', 'no_siswa', 'nama_siswa', 'id_kelas']);
        $account->update(['password' => Hash::make('separate-user-password')]);
        $otherRoleAccount = User::factory()->create([
            'role' => 'guru',
            'password' => Hash::make('keep-other-role-password'),
        ]);

        $this->seed(UserSeeder::class);

        $this->assertDatabaseCount('user', 37);
        $this->assertTrue(Hash::check('Siswa@2026', $account->fresh()->password));
        $this->assertTrue(Hash::check('keep-other-role-password', $otherRoleAccount->fresh()->password));
        $this->assertSame($profileDetails, $profile->fresh()->only(array_keys($profileDetails)));
    }

    public function test_seeding_without_student_profiles_creates_accounts_that_can_only_see_their_incomplete_dashboard(): void
    {
        config()->set('kesiswaan.initial_student_password', 'Siswa@2026');

        $this->seed(UserSeeder::class);

        $this->assertDatabaseCount('user', 36);

        $account = User::query()->where('email', 'maraville@Kesiswaan.id')->firstOrFail();
        $this->assertTrue(Hash::check('Siswa@2026', $account->password));
        $this->assertNull($account->siswa);

        $this->post(route('login.post'), [
            'email' => 'maraville@Kesiswaan.id',
            'password' => 'Siswa@2026',
        ])->assertRedirect(route('dashboard.siswa'));

        $this->get(route('dashboard.siswa'))
            ->assertOk()
            ->assertSee('Andhika Maraville Gazelle')
            ->assertSee('Profil siswa')
            ->assertSee('Belum dilengkapi');
        $this->get(route('profil'))
            ->assertRedirect(route('dashboard.siswa'))
            ->assertSessionHas('warning');
    }

    private function createStudentProfiles(): void
    {
        $class = Kelas::create([
            'nama_kelas' => 'XI PPLG 1',
            'tingkat' => 'XI',
            'jurusan' => 'PPLG',
            'tahun_ajaran' => '2026/2027',
        ]);

        foreach (array_values(UserSeeder::STUDENTS) as $index => $name) {
            Siswa::create([
                'no_siswa' => sprintf('%07d', $index + 1),
                'nama_siswa' => $name,
                'id_kelas' => $class->id_kelas,
                'jenis_kelamin' => 'L',
            ]);
        }
    }
}
