<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Absence;

class AbsenceControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_index_displays_absences()
    {
        Absence::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->get(route('absences.index'));

        $response->assertStatus(200);
        $response->assertViewIs('absences.index');
        $response->assertViewHas('absences');
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('absences.create'));

        $response->assertStatus(200);
        $response->assertViewIs('absences.create');
    }

    public function test_store_creates_absence()
    {
        $data = [
            'user_id' => $this->user->id,
            'date_absence' => '2025-07-20',
            'motif' => 'Raison de test',
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post(route('absences.store'), $data);

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseHas('absences', $data);
    }

    public function test_show_displays_absence()
    {
        $absence = Absence::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('absences.show', $absence));

        $response->assertStatus(200);
        $response->assertViewIs('absences.show');
        $response->assertViewHas('absence', $absence);
    }

    public function test_edit_displays_form()
    {
        $absence = Absence::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('absences.edit', $absence));

        $response->assertStatus(200);
        $response->assertViewIs('absences.edit');
        $response->assertViewHas('absence', $absence);
    }

    public function test_update_modifies_absence()
    {
        $absence = Absence::factory()->create(['user_id' => $this->user->id]);
        $data = [
            'date_absence' => '2025-07-21',
            'motif' => 'Raison de test modifiée',
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(route('absences.update', $absence), $data);

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseHas('absences', $data);
    }

    public function test_destroy_deletes_absence()
    {
        $absence = Absence::factory()->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('absences.destroy', $absence));

        $response->assertRedirect(route('absences.index'));
        $this->assertDatabaseMissing('absences', ['id' => $absence->id]);
    }
}
