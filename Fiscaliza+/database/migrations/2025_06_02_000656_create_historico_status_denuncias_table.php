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
        Schema::create('historico_status_denuncias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('denuncia_id')->constrained('denuncias')->onDelete('cascade');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'rejected']);
            $table->foreignId('atualizado_por_usuario_id')->nullable()->constrained('usuarios')->onDelete('set null');
            $table->text('observacoes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historico_status_denuncias');
    }
};
