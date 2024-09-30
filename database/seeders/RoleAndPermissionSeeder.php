<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Spécifier le guard à utiliser (par défaut c'est `web`, mais tu peux utiliser `api` si c'est le cas dans ton projet)
        $guardName = 'api';


        // Créer les rôles
        $adminRole = Role::create(['name' => 'admin', 'guard_name' => $guardName]);
        $clientRole = Role::create(['name' => 'client', 'guard_name' => $guardName]);
        $professionnelRole = Role::create(['name' => 'professionnel', 'guard_name' => $guardName]);

        // Créer les permissions
        $permissions = [
            'create prestation',
            'edit prestation',
            'delete prestation',
            'view prestation',
            'create reservation',
            'edit reservation',
            'delete reservation',
            'view reservation',
            'create produit',
            'edit produit',
            'delete produit',
            'view produit',
            'create commande',
            'edit commande',
            'delete commande',
            'view commande',
        ];

        // Assigner des rôles à des utilisateurs
$user1 = User::find(1);  // Supposons que cet utilisateur est un admin
$user1->assignRole($adminRole);

$user2 = User::find(2);  // Cet utilisateur est un client
$user2->assignRole($clientRole);

$user3 = User::find(3);  // Cet utilisateur est un professionnel
$user3->assignRole($professionnelRole);

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => $guardName]);
        }

        // Assigner des permissions aux rôles
        $adminRole->givePermissionTo(Permission::all());
        $clientRole->givePermissionTo(['view prestation', 'create reservation', 'view reservation', 'delete reservation', 'view commande',
                                        'create commande, edit commande', 'delete commande']);
        $professionnelRole->givePermissionTo(['create prestation', 'edit prestation', 'view reservation', 'delete prestation', 'view produit',
                                                'create produit', 'edit produit' , 'delete produit', 'view commande', 'delete commande']);
    }
    }

