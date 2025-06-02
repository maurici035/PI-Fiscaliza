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
        Schema::create('notificacoes_admin', function (Blueprint $table) {
            $table->id();
            $table->foreignId('administrador_id')->nullable()->constrained('administradores')->onDelete('cascade');
            $table->string('titulo');
            $table->text('mensagem');
            $table->boolean('lida')->default(false);
            $table->string('tipo_notificacao', 50)->nullable();
            $table->string('tipo_referencia', 50)->nullable();
            $table->unsignedBigInteger('referencia_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notificacoes_admin');
    }
};
