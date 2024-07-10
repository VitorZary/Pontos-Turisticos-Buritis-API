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
            'imagem' => "imagens/6MOAITTn71VfcI9ZHFJsNwDk8nBH7Bp8ip8WPKDT.jpg",
            'pontos_turisticos_id' => PontosTuristicos::all()->random()->id,
        ];
    }
}
