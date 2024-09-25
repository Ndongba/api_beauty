<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Categorie;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Prestation>
 */
class PrestationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'libelle' => $this->faker->word,
            'description' => $this->faker->sentence,
            'prix' => $this->faker->randomFloat(2, 10, 100), // prix avec 2 décimales entre 10 et 100
            'duree' => Carbon::createFromTime(0, 0, 0)->format('H:i:s'), // Convertir en HH:MM:SS
            'categorie_id' => Categorie::factory(), // génère une catégorie a
        ];
    }
}




