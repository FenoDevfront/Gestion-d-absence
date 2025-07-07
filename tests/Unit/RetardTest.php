<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Retard;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class RetardTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de création d'un retard.
     *
     * @return void
     */
    public function test_un_utilisateur_peut_creer_un_retard()
    {
        $user = User::factory()->create();

        $retard = Retard::create([
            'user_id' => $user->id,
            'date' => '2025-07-10',
            'duree' => 30,
            'motif' => 'Transport',
            'statut' => 'en_attente',
        ]);

        $this->assertDatabaseHas('retards', [
            'id' => $retard->id,
        ]);
    }
}