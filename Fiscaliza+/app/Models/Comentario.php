<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comentario extends Model
{
    protected $table = 'comentarios_denuncias'; // Adicione esta linha

    protected $fillable = [
        'denuncia_id',
        'usuario_id',
        'conteudo',
    ];

    // Relacionamento com Denuncia (opcional)
    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class);
    }

    // Relacionamento com Usuario (opcional, ajuste o nome do model se necessário)
    public function usuario() {
        return $this->belongsTo(\App\Models\User::class, 'usuario_id');
    }
}
