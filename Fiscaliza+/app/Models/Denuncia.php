<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'denuncias';

    protected $fillable = [
        'titulo',
        'descricao',
        'localizacao',
        'usuario_id',
        'nome_usuario',
        'foto_path', // Adicione esta linha
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Obtém o usuário que criou a denúncia.
     */
    public function usuario()
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function getFotoUrlAttribute()
    {
        return $this->foto_path ? asset('storage/' . $this->foto_path) : null;
    }
}
