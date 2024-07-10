<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\pontos_turisticos>
 */
class PontosTuristicosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titulo' => fake()->unique()->company(),
            'descricao' => fake()->text(),
            'user_id' => User::all()->random()->id,
            'latitude' => -15.62631,
            'longitude' => -46.42424,
        ];
    }
}
