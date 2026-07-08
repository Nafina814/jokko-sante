<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('cache')) {
            Schema::create('cache', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->mediumText('value');
                $table->integer('expiration')->index();
            });
        }

        if (!Schema::hasTable('cache_locks')) {
            Schema::create('cache_locks', function (Blueprint $table) {
                $table->string('key')->primary();
                $table->string('owner');
                $table->integer('expiration')->index();
            });
        }

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

    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
