<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Proprestation;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Reservation>
 */
class ReservationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "date_prévue" => $this->faker->date,
            "heure_prévue" => $this->faker->time(),
            "montant" => $this->faker->randomFloat(2, 10, 100),
            "status" => $this->faker->randomElement(['reservé', 'terminé']),
            "client_id" => Client::factory(),
            "proprestation_id" => Proprestation::factory(),

        ];
    }
}

