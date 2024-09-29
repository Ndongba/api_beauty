<?php

namespace Database\Seeders;

use App\Models\Proprestation;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProprestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proprestation::factory()->count(20)->create();
    }
}
