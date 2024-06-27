<?php

namespace Database\Factories;

use App\Models\PontosTuristicos;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\imagens>
 */
class ImagensFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'imagem' => "posts/YHWTfB6GgnqzUxwdNmb5iS08gGbLr1pcCVLfVR5g.jpg",
            'pontos_turisticos_id' => PontosTuristicos::all()->random()->id,
        ];
    }
}
