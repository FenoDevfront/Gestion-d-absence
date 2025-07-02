<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Conge>
 */
class CongeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => \App\Models\User::factory(),
            'date_debut' => $this->faker->dateTimeBetween('-1 month', '+1 month'),
            'date_fin' => $this->faker->dateTimeBetween('+1 month', '+2 months'),
            'type_conge' => $this->faker->randomElement(['paye', 'sans_solde', 'maladie']),
            'status' => 'en_attente',
        ];
    }
}
