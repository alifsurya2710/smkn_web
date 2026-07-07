<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Spatie\Permission\Models\Role;

class RoleAccessTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        
        // Seed roles
        $roles = ['super_admin', 'admin', 'editor', 'guru', 'siswa'];
        foreach ($roles as $roleName) {
            Role::create(['name' => $roleName]);
        }
    }

    /** @test */
    public function super_admin_is_redirected_to_super_admin_dashboard()
    {
        $user = User::factory()->create();
        $user->assignRole('super_admin');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('super_admin.dashboard'));
    }

    /** @test */
    public function siswa_is_redirected_to_e_rapor()
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $response = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('e-rapor'));
    }

    /** @test */
    public function user_without_permission_cannot_access_super_admin_dashboard()
    {
        $user = User::factory()->create();
        $user->assignRole('siswa');

        $this->actingAs($user);

        $response = $this->get('/super-admin/dashboard');
        $response->assertStatus(403);
    }
}
