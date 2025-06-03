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
        Schema::create('administradores', function (Blueprint $table) {
$table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('senha');
            $table->date('data_nascimento')->nullable();
            $table->string('telefone', 20)->nullable();
            $table->string('telefone_secundario', 20)->nullable();
            $table->string('imagem_perfil')->nullable();
            $table->timestamp('ultimo_login')->nullable();
            $table->boolean('super_administrador')->default(false);
            $table->string('token_lembrar', 100)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('administradores');
    }
};
