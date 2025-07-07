<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Absence;
use App\Models\User;
// use Illuminate\Foundation\Testing\RefreshDatabase;

class AbsenceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test de création d'une absence.
     *
     * @return void
     */
    public function test_un_utilisateur_peut_creer_une_absence()
    {
        $user = User::factory()->create();

        $absence = Absence::create([
            'user_id' => $user->id,
            'date_debut' => '2025-07-10',
            'date_fin' => '2025-07-11',
            'motif' => 'Maladie',
            'statut' => 'en_attente',
        ]);

        $this->assertDatabaseHas('absences', [
            'id' => $absence->id,
        ]);
    }
}