<?php

namespace Database\Factories;

use App\Models\Prestation;
use App\Models\Professionnel;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Proprestation>
 */
class ProprestationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'professionnel_id' => Professionnel::factory(),
            'prestation_id' => Prestation::factory(),
        ];
    }
}
