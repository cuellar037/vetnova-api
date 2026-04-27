<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecetaDetalle extends Model
{
    protected $fillable = [
        'receta_id', 
        'tipo', 
        'producto_id', 
        'descripcion', 
        'cantidad', 
        'precio'
    ];

    public function receta()
    {
        return $this->belongsTo(Receta::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
