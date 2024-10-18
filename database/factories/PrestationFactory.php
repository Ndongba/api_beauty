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
    public function definition()
    {
        // // Générer une durée aléatoire entre 30 et 120 minutes
        // $minutes = $this->faker->numberBetween(30, 120); // Durée en minutes
        // $hours = floor($minutes / 60);
        // $remainingMinutes = $minutes % 60;

        // return [
        //     'libelle' => $this->faker->word,
        //     'description' => $this->faker->sentence,
        //     'prix' => $this->faker->randomFloat(2, 10, 100), // prix avec 2 décimales entre 10 et 100
        //     'duree' => sprintf('%02d:%02d:%02d', $hours, $remainingMinutes, 0), // Formatage en HH:MM:SS
        //     'categorie_id' => Categorie::factory(), // génère une catégorie
        // ];
    }


}




