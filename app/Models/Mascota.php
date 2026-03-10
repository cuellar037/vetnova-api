<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mascota extends Model
{
    protected $table = 'mascotas';

    protected $fillable = [
        'nombre',
        'edad',
        'genero',
        'especie',        
        'cliente_id'
    ];

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function citas()
    {
        return $this->hasMany(Cita::class);
    }

    public function recetas ()
    {
        return $this->hasMany(Receta::class);
    }
}
