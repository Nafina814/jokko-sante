<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['nom' => 'admin',       'description' => 'Administrateur de la plateforme'],
            ['nom' => 'psychologue', 'description' => 'Professionnel de santé mentale'],
            ['nom' => 'utilisateur', 'description' => 'Étudiant ou femme bénéficiaire'],
            ['nom' => 'pair_aidant', 'description' => 'Badienou Gokh ou pair-aidant'],
        ];

        foreach ($roles as $role) {
            DB::table('roles')->updateOrInsert(
                ['nom' => $role['nom']],
                array_merge($role, ['created_at' => now(), 'updated_at' => now()])
            );
        }
    }
}