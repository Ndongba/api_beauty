<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professionnel>
 */
class ProfessionnelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'description' => $this->faker->sentence,
            'date_ouverture' => $this->faker->date,
            'date_fermeture' => $this->faker->date,
            'heure_ouverture' => $this->faker->time,
            'heure_fermeture' => $this->faker->time,
            'ninea' => 'documents/fake_ninea.pdf', // Chemin fictif pour un fichier NINEA
            'registre_commerce' => 'documents/fake_registre.pdf', // Chemin fictif pour un fichier Registre de Commerce
            'user_id' => User::factory(),
        ];
    }
}
