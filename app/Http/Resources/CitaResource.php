<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CitaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'cliente' => $this->cliente?->nombre,
            'mascota' => $this->mascota?->nombre,
            'doctor' => $this->doctor?->nombre,
            'motivo' => $this->motivo,
            'fecha_cita' => $this->fecha_cita,
            'hora_cita' => $this->hora_cita,
            'estado' => $this->estado,
            'created_at' => $this->created_at,
        ];
    }
}
