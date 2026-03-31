<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Proveedor;

class ProveedoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'nombre' => 'VetDistribuciones S.A',
            'direccion' => 'Bogotá, Colombia',
            'email' => 'contacto@vetdist.com',
            'telefono' => '3001234567'
        ]);

        Proveedor::create([
            'nombre' => 'Mascotas Global',
            'direccion' => 'Medellín, Colombia',
            'email' => 'ventas@mascotasglobal.com',
            'telefono' => '3019876543'
        ]);

        Proveedor::create([
            'nombre' => 'AnimalCare Proveedores',
            'direccion' => 'Cali, Colombia',
            'email' => 'info@animalcare.com',
            'telefono' => '3024567890'
        ]);

        Proveedor::create([
            'nombre' => 'Distribuidora PetShop',
            'direccion' => 'Barranquilla, Colombia',
            'email' => 'contacto@petshop.com',
            'telefono' => '3051122334'
        ]);
    }
}
