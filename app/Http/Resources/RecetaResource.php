<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecetaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'cita_id' => $this->cita_id,
            'cliente_id' => $this->cliente_id,
            'mascota_id' => $this->mascota_id,
            'veterinario' => $this->doctor_id,
            'observaciones' => $this->observaciones,
            'fecha' => $this->fecha,
            'detalles' => RecetaDetalleResource::collection($this->detalles),
        ];
    }
}
