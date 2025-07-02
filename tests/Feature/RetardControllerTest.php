<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Retard;

class RetardControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_index_displays_retards()
    {
        Retard::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->get(route('retards.index'));

        $response->assertStatus(200);
        $response->assertViewIs('retards.index');
        $response->assertViewHas('retards');
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('retards.create'));

        $response->assertStatus(200);
        $response->assertViewIs('retards.create');
    }

    public function test_store_creates_retard()
    {
        $data = [
            'user_id' => $this->user->id,
            'date_retard' => '2025-07-20',
            'duree' => 30,
            'motif' => 'Raison de test',
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post(route('retards.store'), $data);

        $response->assertRedirect(route('retards.index'));
        $this->assertDatabaseHas('retards', $data);
    }

    public function test_show_displays_retard()
    {
        $retard = Retard::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('retards.show', $retard));

        $response->assertStatus(200);
        $response->assertViewIs('retards.show');
        $response->assertViewHas('retard', $retard);
    }

    public function test_edit_displays_form()
    {
        $retard = Retard::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('retards.edit', $retard));

        $response->assertStatus(200);
        $response->assertViewIs('retards.edit');
        $response->assertViewHas('retard', $retard);
    }

    public function test_update_modifies_retard()
    {
        $retard = Retard::factory()->create(['user_id' => $this->user->id]);
        $data = [
            'date_retard' => '2025-07-21',
            'duree' => 45,
            'motif' => 'Raison de test modifiée',
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(route('retards.update', $retard), $data);

        $response->assertRedirect(route('retards.index'));
        $this->assertDatabaseHas('retards', $data);
    }

    public function test_destroy_deletes_retard()
    {
        $retard = Retard::factory()->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('retards.destroy', $retard));

        $response->assertRedirect(route('retards.index'));
        $this->assertDatabaseMissing('retards', ['id' => $retard->id]);
    }
}
