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
        'foto',
        'video',
        'localizacao_texto',
        'latitude',
        'longitude',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }
}
