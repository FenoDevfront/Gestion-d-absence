<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function un_utilisateur_a_un_role_par_defaut()
    {
        $user = User::factory()->create();
        $this->assertEquals('employe', $user->role);
    }

    /** @test */
    public function un_utilisateur_peut_avoir_un_role_different()
    {
        $user = User::factory()->create(['role' => 'superviseur']);
        $this->assertEquals('superviseur', $user->role);
    }
}
