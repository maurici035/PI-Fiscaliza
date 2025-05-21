<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Usuario extends Authenticatable
{
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'senha'];

    protected $hidden = ['senha'];

    // Se sua senha não estiver usando o campo default "password"
    public function getAuthPassword()
    {
        return $this->senha;
    }
}
