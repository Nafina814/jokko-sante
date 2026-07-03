<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->default(3)->constrained('roles');
            $table->string('telephone')->nullable();
            $table->enum('genre', ['homme', 'femme', 'autre'])->nullable();
            $table->string('universite')->nullable();
            $table->boolean('anonyme')->default(false);
            $table->boolean('actif')->default(true);
        });
    }
    
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn(['role_id','telephone','genre','universite','anonyme','actif']);
        });
    }

    /**
     * Reverse the migrations.
     */
   
};
