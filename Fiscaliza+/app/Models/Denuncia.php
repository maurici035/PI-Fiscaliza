<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Denuncia extends Model
{
    protected $table = 'denuncias';

    use HasFactory;

    protected $fillable = [
        'descricao',
        'localizacao_texto',
        'latitude',
        'longitude',
        'endereco',
        'foto_path',
        'video_path',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function comentarios()
    {
        return $this->hasMany(ComentariosDenuncias::class, 'denuncia_id');
    }

    public function curtidas()
    {
        return $this->hasMany(CurtidasDenuncias::class, 'denuncia_id');
    }
}
