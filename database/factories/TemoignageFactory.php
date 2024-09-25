<?php

namespace Database\Factories;


use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Temoignage>
 */
class TemoignageFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'titre' => $this->faker->word,
            'contenu' => $this->faker->sentence,
            'client_id' => Client::factory(),
        ];
    }
}
