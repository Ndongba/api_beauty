<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user1 = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
            ]
        );

        $user2 = User::firstOrCreate(
            ['email' => 'client@example.com'],
            [
                'name' => 'Client User',
                'password' => Hash::make('password'),
            ]
        );

        $user3 = User::firstOrCreate(
            ['email' => 'professionnel@example.com'],
            [
                'name' => 'Professionnel User',
                'password' => Hash::make('password'),
            ]
        );

        // Attribuer les rôles avec le guard `api`
        $adminRole = Role::where('name', 'admin')->where('guard_name', 'api')->first();
        $clientRole = Role::where('name', 'client')->where('guard_name', 'api')->first();
        $professionnelRole = Role::where('name', 'professionnel')->where('guard_name', 'api')->first();

        if ($user1) {
            $user1->assignRole($adminRole);
        }

        if ($user2) {
            $user2->assignRole($clientRole);
        }

        if ($user3) {
            $user3->assignRole($professionnelRole);
        }
    }
}
