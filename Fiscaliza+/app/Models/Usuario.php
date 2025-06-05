<?php
namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Notifications\ResetPassword;

class Usuario extends Authenticatable implements CanResetPassword
{
    use Notifiable;
    protected $table = 'usuarios';

    protected $fillable = ['nome', 'email', 'senha', 'data_nascimento', 'foto_perfil', 'is_admin'];

    protected $hidden = ['senha'];

    /**
     * Atributos que devem ser convertidos para tipos nativos.
     */
    protected $casts = [
        'data_nascimento' => 'date',
        'is_admin' => 'boolean',
    ];

    // Se sua senha não estiver usando o campo default "password"
    public function getAuthPassword()
    {
        return $this->senha;
    }

    /**
     * Obtém todas as denúncias feitas pelo usuário.
     */
    public function denuncias()
    {
        return $this->hasMany(Denuncia::class, 'usuario_id');
    }

    /**
     * Obtém a URL da foto de perfil do usuário
     */
    public function getFotoPerfilUrlAttribute()
    {
        if ($this->foto_perfil) {
            return asset('storage/' . $this->foto_perfil);
        }
        return asset('assets/foto_usuario.png');
    }

    /**
     * Get the e-mail address where password reset links are sent.
     */
    public function getEmailForPasswordReset()
    {
        return $this->email;
    }

    /**
     * Send the password reset notification.
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
