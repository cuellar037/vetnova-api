<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cita extends Model
{
    protected $table = 'citas';

    protected $fillable = [
        'cliente_id',
        'mascota_id',
        'doctor_id',
        'motivo',
        'servicio',
        'fecha_solicitud',
        'fecha_cita',
        'hora',
        'estado'
    ];

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
