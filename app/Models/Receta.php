<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receta extends Model
{
    protected $table = 'recetas';

    protected $fillable = [
        'doctor_id',
        'cliente_id',
        'mascota_id',
        'procedimiento',
        'total',
        'fecha'
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }

    public function productos()
    {
        return $this->belongsToMany(
            Producto::class, 
            'receta_productos'
        )->withPivot('cantidad', 'precio');
    }

}
