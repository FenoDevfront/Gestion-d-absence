<?php

namespace Tests\Feature\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserManagementTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Teste la redirection des utilisateurs non authentifiés.
     *
     * @return void
     */
    public function test_les_utilisateurs_non_authentifies_sont_rediriges()
    {
        $response = $this->get(route('admin.users.index'));
        $response->assertRedirect(route('login'));
    }

    /**
     * Teste que les utilisateurs non-administrateurs ne peuvent pas accéder à la gestion des utilisateurs.
     *
     * @return void
     */
    public function test_les_utilisateurs_non_admin_ne_peuvent_pas_acceder_a_la_page()
    {
        $user = User::factory()->create(['role' => 'employe']);
        $this->actingAs($user);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(403);
    }

    /**
     * Teste que les administrateurs peuvent accéder à la gestion des utilisateurs.
     *
     * @return void
     */
    public function test_les_admins_peuvent_acceder_a_la_page()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(200);
    }

    /**
     * Teste que les administrateurs peuvent mettre à jour le rôle d'un utilisateur.
     *
     * @return void
     */
    public function test_un_admin_peut_mettre_a_jour_le_role_dun_utilisateur()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create(['role' => 'employe']);
        $this->actingAs($admin);

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(route('admin.users.update', $user), ['role' => 'superviseur']);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'role' => 'superviseur',
        ]);
    }

    /**
     * Teste qu'un administrateur peut supprimer un utilisateur.
     *
     * @return void
     */
    public function test_un_admin_peut_supprimer_un_utilisateur()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $user = User::factory()->create();
        $this->actingAs($admin);

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('admin.users.destroy', $user));

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    /**
     * Teste qu'un administrateur ne peut pas se supprimer lui-même.
     *
     * @return void
     */
    public function test_un_admin_ne_peut_pas_se_supprimer_lui_meme()
    {
        $admin = User::factory()->create(['role' => 'admin']);
        $this->actingAs($admin);

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('admin.users.destroy', $admin));

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['id' => $admin->id]);
    }
}