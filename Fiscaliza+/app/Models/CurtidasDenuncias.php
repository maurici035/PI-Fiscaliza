<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurtidasDenuncias extends Model
{
    use HasFactory;

    protected $table = 'curtidas_denuncias';

    protected $fillable = [
        'denuncia_id',
        'user_id',
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
