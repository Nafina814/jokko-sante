<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('numero_ordre')->nullable()->after('universite');
            $table->string('specialite')->nullable()->after('numero_ordre');
            $table->string('etablissement')->nullable()->after('specialite');
            $table->string('type_pair_aidant')->nullable()->after('etablissement'); // badienou_gokh, ong, benevole
            $table->text('motivation')->nullable()->after('type_pair_aidant');
            $table->string('organisation')->nullable()->after('motivation');
            $table->enum('statut_validation', ['en_attente', 'valide', 'rejete'])->default('valide')->after('organisation');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'numero_ordre', 'specialite', 'etablissement',
                'type_pair_aidant', 'motivation', 'organisation', 'statut_validation'
            ]);
        });
    }
};