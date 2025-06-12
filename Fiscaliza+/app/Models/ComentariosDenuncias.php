<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComentariosDenuncias extends Model
{
    use HasFactory;

    protected $fillable = [
        'denuncia_id',
        'user_id',
        'conteudo'
    ];

    public function user()
    {
        return $this->belongsTo(Usuario::class, 'user_id');
    }

    public function denuncia()
    {
        return $this->belongsTo(Denuncia::class, 'denuncia_id');
    }
}
