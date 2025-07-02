<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Conge;

class CongeControllerTest extends TestCase
{
    use RefreshDatabase;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    public function test_index_displays_conges()
    {
        Conge::factory()->count(3)->create(['user_id' => $this->user->id]);

        $response = $this->get(route('conges.index'));

        $response->assertStatus(200);
        $response->assertViewIs('conges.index');
        $response->assertViewHas('conges');
    }

    public function test_create_displays_form()
    {
        $response = $this->get(route('conges.create'));

        $response->assertStatus(200);
        $response->assertViewIs('conges.create');
    }

    public function test_store_creates_conge()
    {
        $data = [
            'user_id' => $this->user->id,
            'date_debut' => '2025-07-20',
            'date_fin' => '2025-07-22',
            'motif' => 'Raison de test',
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->post(route('conges.store'), $data);

        $response->assertRedirect(route('conges.index'));
        $this->assertDatabaseHas('conges', $data);
    }

    public function test_show_displays_conge()
    {
        $conge = Conge::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('conges.show', $conge));

        $response->assertStatus(200);
        $response->assertViewIs('conges.show');
        $response->assertViewHas('conge', $conge);
    }

    public function test_edit_displays_form()
    {
        $conge = Conge::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('conges.edit', $conge));

        $response->assertStatus(200);
        $response->assertViewIs('conges.edit');
        $response->assertViewHas('conge', $conge);
    }

    public function test_update_modifies_conge()
    {
        $conge = Conge::factory()->create(['user_id' => $this->user->id]);
        $data = [
            'date_debut' => '2025-07-21',
            'date_fin' => '2025-07-23',
            'motif' => 'Raison de test modifiée',
        ];

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->put(route('conges.update', $conge), $data);

        $response->assertRedirect(route('conges.index'));
        $this->assertDatabaseHas('conges', $data);
    }

    public function test_destroy_deletes_conge()
    {
        $conge = Conge::factory()->create(['user_id' => $this->user->id]);

        $response = $this->withHeaders([
            'X-CSRF-TOKEN' => csrf_token(),
        ])->delete(route('conges.destroy', $conge));

        $response->assertRedirect(route('conges.index'));
        $this->assertDatabaseMissing('conges', ['id' => $conge->id]);
    }
}
