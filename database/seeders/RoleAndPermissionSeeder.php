<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName = 'web';

        // Créer les rôles
        $adminRole = Role::firstOrCreate(['name' => 'admin', 'guard_name' => $guardName]);
        $clientRole = Role::firstOrCreate(['name' => 'client', 'guard_name' => $guardName]);
        $professionnelRole = Role::firstOrCreate(['name' => 'professionnel', 'guard_name' => $guardName]);

        // Créer les permissions
        $permissions = [
            'create prestation', 'edit prestation', 'delete prestation', 'view prestation',
            'create reservation', 'update reservation', 'delete reservation', 'view reservation',
            'create produit', 'edit produit', 'delete produit', 'view produit',
            'create commande', 'edit commande', 'delete commande', 'view commande',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guardName]);
        }

        // Assigner toutes les permissions au rôle admin
        $adminRole->givePermissionTo(Permission::all());

        // Assigner des permissions spécifiques aux rôles client et professionnel
        $clientRole->givePermissionTo([
            'view prestation', 'create reservation', 'view reservation', 'update reservation',
            'delete reservation', 'view commande', 'create commande', 'edit commande', 'delete commande'
        ]);

        $professionnelRole->givePermissionTo([
            'create prestation', 'edit prestation', 'view reservation', 'delete prestation',
            'view produit', 'create produit', 'edit produit', 'delete produit', 'view commande', 'delete commande'
        ]);
    }
}
