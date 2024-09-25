<?php

namespace Database\Seeders;

use App\Models\Professionnel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionnelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Professionnel::factory()->count(10)->create();
    }
}
