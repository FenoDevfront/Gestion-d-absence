<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;

class AdminControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_access_dashboard()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/dashboard');
        $response->assertStatus(200);
    }

    public function test_non_admin_cannot_access_dashboard()
    {
        $user = User::factory()->create(['role' => 'employe']);
        $response = $this->actingAs($user)->get('/admin/dashboard');
        $response->assertStatus(403);
    }

    public function test_admin_can_see_users_list()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $response = $this->actingAs($admin)->get('/admin/users');
        $response->assertStatus(200);
    }

    public function test_admin_can_update_user_role()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'employe']);

        $response = $this->actingAs($admin)
                         ->withHeaders(['X-CSRF-TOKEN' => csrf_token()])
                         ->put('/admin/users/' . $user->id, ['role' => 'superviseur']);

        $response->assertRedirect('/admin/users');
        $this->assertDatabaseHas('users', ['id' => $user->id, 'role' => 'superviseur']);
    }
}
