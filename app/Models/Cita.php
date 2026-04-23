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
        'hora_cita',
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

    public function withValidator($validator){
        $validator->after(function($validator){
            
            // Validar que la mascota pertenezca al cliente
            $mascota = Mascota::find($this->mascota_id);
            
            if($mascota && $mascota->cliente_id !== $this->cliente_id){
                $validator->errors()->add('mascota_id', 'La mascota no pertenece al cliente.');
            }
            
            // Validar que la hora esté en intervalos de 30 minutos
            if(!in_array(substr($this->hora_cita, 3, 2), ['00', '30'])){
                $validator->errors()->add('hora_cita', 'La hora de la cita debe ser intervalos de 30 minutos.');
            }

            $existe = \App\Models\Cita::where('doctor_id', $this->doctor_id)
                ->where('fecha_cita', $this->fecha_cita)
                ->where('hora_cita', $this->hora_cita)
                ->exists();
            
            if($existe){
                $validator->errors()->add('hora_cita', 'Ya existe una cita en ese horario.');
            }

            if ($this->fecha_cita < now()->toDateString()) {
                $validator->errors()->add('fecha_cita', 'No puedes agendar en fechas pasadas.');
            }

        });
    }
}
