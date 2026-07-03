<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['nom' => 'admin',        'description' => 'Administrateur de la plateforme', 'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'psychologue',  'description' => 'Professionnel de santé mentale',  'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'utilisateur',  'description' => 'Étudiant ou femme bénéficiaire',  'created_at' => now(), 'updated_at' => now()],
            ['nom' => 'pair_aidant',  'description' => 'Badienou Gokh ou pair-aidant',    'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}