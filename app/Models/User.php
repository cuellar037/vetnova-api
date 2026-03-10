<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'usuarios';

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'dni',
        'nombre',
        'apellido',
        'username',
        'password',
        'email',
        'direccion',
        'zona',
        'telefono',
        'telefono_alt',
        'rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class, 'cliente_id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class, 'cliente_id');
    }

}
