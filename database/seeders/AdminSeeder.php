<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name'       => 'Administrateur',
            'email'      => 'finabadji30@gmail.com',
            'password'   => Hash::make('Admin@2025!'),
            'role_id'    => 1,
            'actif'      => true,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}