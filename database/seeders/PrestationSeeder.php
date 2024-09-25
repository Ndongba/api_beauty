<?php

namespace Database\Seeders;

use App\Models\Prestation;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PrestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prestation

        Prestation::factory()->count(10)->create();
    }
}
