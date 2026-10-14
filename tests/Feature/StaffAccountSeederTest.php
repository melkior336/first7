<?php

namespace Tests\Feature;

use App\Models\GuruBk;
use App\Models\User;
use Database\Seeders\StaffAccountSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class StaffAccountSeederTest extends TestCase
{
    use RefreshDatabase;

    public function test_staff_seeder_creates_idempotent_accounts_that_can_login_to_their_dashboards(): void
    {
        config()->set('kesiswaan.initial_account_password', 'test-staff-password');

        $this->seed(StaffAccountSeeder::class);
        $this->seed(StaffAccountSeeder::class);

        $this->assertDatabaseCount('user', 3);
        $this->assertDatabaseCount('guru', 2);
        $this->assertDatabaseCount('guru_bk', 1);

        $accounts = [
            ['email' => 'admin@kesiswaan.local', 'role' => 'admin', 'dashboard' => 'dashboard.admin'],
            ['email' => 'guru@kesiswaan.local', 'role' => 'guru', 'dashboard' => 'dashboard.guru'],
            ['email' => 'bk@kesiswaan.local', 'role' => 'guru_bk', 'dashboard' => 'dashboard.guru_bk'],
        ];

        foreach ($accounts as $attributes) {
            $account = User::query()->where('email', $attributes['email'])->firstOrFail();

            $this->assertSame($attributes['role'], $account->role);
            $this->assertTrue(Hash::check('test-staff-password', $account->password));

            $this->post(route('login.post'), [
                'email' => $attributes['email'],
                'password' => 'test-staff-password',
            ])->assertRedirect(route($attributes['dashboard']));

            $this->assertAuthenticatedAs($account);
            $this->get(route($attributes['dashboard']))->assertOk();
            $this->post(route('logout'));
        }

        $this->assertTrue(
            GuruBk::query()->where('status_aktif', true)->exists(),
        );
    }

    public function test_legacy_teacher_dashboard_aliases_require_authentication_and_teacher_role(): void
    {
        $this->get('/dashboardguru')->assertRedirect(route('login'));
        $this->get('/dashboard-guru')->assertRedirect(route('login'));

        $admin = User::factory()->create(['role' => 'admin']);

        $this->actingAs($admin)->get('/dashboardguru')->assertForbidden();
        $this->actingAs($admin)->get('/dashboard-guru')->assertForbidden();
    }
}
