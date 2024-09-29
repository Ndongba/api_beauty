<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Produit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Commande>
 */
class CommandeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
           "quantite" => $this->faker->numberBetween(1, 100),  // Génère un nombre entier entre 1 et 100
            'prix_total' => $this->faker->randomFloat(2, 10, 100),  // Génère un nombre décimal avec 2 décimales
            "client_id" => Client::factory(),  // Associe un client via une factory
            "produit_id" => Produit::factory(),  // Associe un produit via une factory
        ];
    }
}
