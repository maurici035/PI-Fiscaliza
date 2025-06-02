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
        Schema::create('logs_acao_admin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrador_id')->constrained('administradores')->onDelete('cascade');
            $table->string('tipo_acao', 50);
            $table->text('descricao');
            $table->string('tipo_entidade', 50)->nullable();
            $table->unsignedBigInteger('entidade_id')->nullable();
            $table->string('endereco_ip', 45)->nullable();
            $table->text('agente_usuario')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logs_acao_admin');
    }
};
