<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Proveedor;

class ProductosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener IDs existentes
        $categorias = Categoria::pluck('id');
        $proveedores = Proveedor::pluck('id');

        Producto::create([
            'nombre' => 'Antipulgas Canino',
            'descripcion' => 'Tratamiento para pulgas en perros',
            'precio_compra' => 10000,
            'precio_venta' => 15000,
            'stock' => 50,
            'categoria_id' => $categorias->random(),
            'proveedor_id' => $proveedores->random(),
        ]);

        Producto::create([
            'nombre' => 'Alimento Premium Gatos',
            'descripcion' => 'Alimento balanceado para gatos adultos',
            'precio_compra' => 20000,
            'precio_venta' => 28000,
            'stock' => 30,
            'categoria_id' => $categorias->random(),
            'proveedor_id' => $proveedores->random(),
        ]);

        Producto::create([
            'nombre' => 'Shampoo Antipulgas',
            'descripcion' => 'Producto de higiene para mascotas',
            'precio_compra' => 8000,
            'precio_venta' => 12000,
            'stock' => 40,
            'categoria_id' => $categorias->random(),
            'proveedor_id' => $proveedores->random(),
        ]);

        Producto::create([
            'nombre' => 'Collar Ajustable',
            'descripcion' => 'Collar para perros pequeños',
            'precio_compra' => 5000,
            'precio_venta' => 9000,
            'stock' => 60,
            'categoria_id' => $categorias->random(),
            'proveedor_id' => $proveedores->random(),
        ]);
    }
}
