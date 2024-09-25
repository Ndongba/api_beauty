<?php

namespace Database\Factories;

use App\Models\Categorie;
use App\Models\Professionnel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Produit>
 */
class ProduitFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "nom" => $this->faker->word,
            "description" => $this->faker->sentence,
            "image" => 'documents/image1.jpeg',
            "professionnel_id" => Professionnel::factory(),
            "categorie_id" => Categorie::factory(),
        ];
    }
}
