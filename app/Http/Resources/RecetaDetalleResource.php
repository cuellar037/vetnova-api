<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecetaDetalleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'tipo' => $this->tipo, 
            'producto_id' => $this->producto ? $this->producto->id : null,
            'descripcion' => $this->descripcion,
            'cantidad' => $this->cantidad,
            'precio' => $this->precio,
        ];
    }
}
