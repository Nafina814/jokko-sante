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
        Schema::create('reponses_phq9', function (Blueprint $table) {
            $table->id();
            $table->foreignId('test_id')->constrained('tests_phq9')->onDelete('cascade');
            $table->integer('question_numero'); // 1 à 9
            $table->integer('score'); // 0, 1, 2, 3
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reponses_phq9');
    }
};
