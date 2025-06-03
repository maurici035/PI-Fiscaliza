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
        Schema::create('relatorios_gerados', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrador_id')->constrained('administradores')->onDelete('cascade');
            $table->string('tipo_relatorio', 100);
            $table->text('parametros_relatorio')->nullable();
            $table->string('caminho_arquivo')->nullable();
            $table->integer('tamanho_arquivo')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('relatorios_gerados');
    }
};
