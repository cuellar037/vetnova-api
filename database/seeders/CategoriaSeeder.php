<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Medicamentos',
            'descripcion' => 'Productos farmacéuticos veterinarios'
        ]);

        Categoria::create([
            'nombre' => 'Alimentos',
            'descripcion' => 'Comida para mascotas'
        ]);

        Categoria::create([
            'nombre' => 'Accesorios',
            'descripcion' => 'Collares, correas, juguetes'
        ]);

        Categoria::create([
            'nombre' => 'Higiene',
            'descripcion' => 'Shampoo, cuidado personal'
        ]);
    }
}
