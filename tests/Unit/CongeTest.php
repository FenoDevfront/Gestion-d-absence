<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Conge;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class CongeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de création d'un congé.
     *
     * @return void
     */
    public function test_un_utilisateur_peut_creer_un_conge()
    {
        $user = User::factory()->create();

        $conge = Conge::create([
            'user_id' => $user->id,
            'date_debut' => '2025-07-10',
            'date_fin' => '2025-07-11',
            'motif' => 'Vacances',
            'statut' => 'en_attente',
            'type_conge' => 'paye',
        ]);

        $this->assertDatabaseHas('conges', [
            'id' => $conge->id,
        ]);
    }
}