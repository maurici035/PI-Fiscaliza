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
        Schema::create('curtidas_denuncias', function (Blueprint $table) {
            $table->id();

            // FK para 'denuncias.id'
            $table->foreignId('denuncia_id')
                ->constrained('denuncias')
                ->onDelete('cascade');

            $table->foreignId('user_id')
                ->constrained('usuarios')
                ->onDelete('cascade');

            $table->unique(['denuncia_id', 'user_id']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curtidas_denuncias');
    }
};
