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
        Schema::create('festivais', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('local');
            $table->dateTime('data_horario');
            $table->string('capacidade');
            $table->json('artistas'); // Ideal para armazenar uma lista simples
            $table->string('imagem_path')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('festivais');
    }
};
