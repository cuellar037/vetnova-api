<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'recetas';

    protected $fillable = [
        'cita_id',
        'doctor_id',
        'cliente_id',
        'mascota_id',
        'observaciones',
        'fecha'
    ];

    public function cita()
    {
        return $this->belongsTo(Cita::class);
    }

    public function detalles()
    {
        return $this->hasMany(RecetaDetalle::class);
    }

    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'doctor_id');
    }

}
