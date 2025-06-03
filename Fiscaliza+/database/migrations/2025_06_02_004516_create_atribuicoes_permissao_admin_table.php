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
        Schema::create('atribuicoes_permissao_admin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrador_id')->constrained('administradores')->onDelete('cascade');
            $table->foreignId('permissao_id')->constrained('permissoes_admin')->onDelete('cascade');
            $table->unique(['administrador_id', 'permissao_id']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('atribuicoes_permissao_admin');
    }
};
