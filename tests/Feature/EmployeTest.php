<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use App\Models\User;
use App\Models\Absence;

class EmployeTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    protected function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    /**
     * Test de la soumission d'une demande d'absence par un employé.
     *
     * @return void
     */
    public function test_un_employe_peut_soumettre_une_demande_d_absence()
    {
        // Crée un utilisateur avec le rôle 'employe'
        $employe = User::factory()->create(['role' => 'employe']);

        // Agit en tant que cet utilisateur
        $this->actingAs($employe);

        // Données de la demande d'absence
        $absenceData = [
            'employee_id' => $employe->id,
            'date_absence' => '2025-08-01',
            'motif' => 'Raison personnelle',
        ];

        // Envoie une requête POST pour créer l'absence
        $response = $this->post(route('absences.store'), $absenceData);

        // Vérifie que la redirection s'est bien passée
        $response->assertStatus(302);
        $response->assertRedirect(route('absences.index'));

        // Vérifie que l'absence a bien été créée dans la base de données
        $this->assertDatabaseHas('absences', [
            'user_id' => $employe->id,
            'date_debut' => '2025-08-01',
            'date_fin' => '2025-08-02',
            'motif' => 'Raison personnelle',
            'statut' => 'en_attente', // ou le statut par défaut
        ]);
    }
}

