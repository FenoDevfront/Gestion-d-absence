<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

use Illuminate\Foundation\Testing\WithoutMiddleware;

class RoleMiddlewareTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function un_employe_peut_acceder_a_ses_demandes()
    {
        $user = User::factory()->create(['role' => 'employe']);
        $this->actingAs($user);

        $this->get('/absences')->assertStatus(200);
    }

    /** @test */
    public function un_employe_ne_peut_pas_valider_de_demandes()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = User::factory()->create(['role' => 'employe']);
        $this->actingAs($user);
        $absence = \App\Models\Absence::factory()->create();

        $this->put('/absences/' . $absence->id, [])->assertStatus(403);
    }

    /** @test */
    public function un_superviseur_peut_valider_des_demandes()
    {
        $this->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);
        $user = User::factory()->create(['role' => 'superviseur']);
        $this->actingAs($user);

        // On simule une absence existante
        $absence = \App\Models\Absence::factory()->create();

        $this->put('/absences/' . $absence->id, [
            'status' => 'en_cours',
            'user_id' => $absence->user_id,
            'date_debut' => $absence->date_debut,
            'date_fin' => $absence->date_fin,
            'motif' => $absence->motif,
        ])->assertStatus(302); // Redirection après succès
    }
}
