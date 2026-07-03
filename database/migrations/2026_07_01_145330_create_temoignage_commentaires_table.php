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
        Schema::create('temoignage_commentaires', function (Blueprint $table) {

            $table->id();

            // Auteur du commentaire
            $table->foreignId('user_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Témoignage concerné
            $table->foreignId('temoignage_id')
                  ->constrained()
                  ->cascadeOnDelete();

            // Contenu
            $table->text('contenu');

            // Publication anonyme
            $table->boolean('anonyme')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temoignage_commentaires');
    }
};