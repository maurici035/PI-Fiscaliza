<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'senha', 'data_nascimento'];

    protected $hidden = ['senha'];

    protected $casts = [
        'data_nascimento' => 'date',
    ];

    // Se sua senha não estiver usando o campo default "password"
    public function getAuthPassword()
    {
        return $this->senha;
    }

    public function denuncias()
    {
        return $this->hasMany(Denuncia::class, 'user_id');
    }

}
