<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Medicamentos',
            'descripcion' => 'Productos farmacéuticos veterinarios',
            'estado' => 'Activo'
        ]);

        Categoria::create([
            'nombre' => 'Alimentos',
            'descripcion' => 'Comida para mascotas',
            'estado' => 'Activo'
        ]);

        Categoria::create([
            'nombre' => 'Accesorios',
            'descripcion' => 'Collares, correas, juguetes',
            'estado' => 'Activo'
        ]);

        Categoria::create([
            'nombre' => 'Higiene',
            'descripcion' => 'Shampoo, cuidado personal',
            'estado' => 'Activo'
        ]);
    }
}
