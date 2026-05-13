<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsuariosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'dni' => '100000001',
            'nombre' => 'Admin',
            'apellido' => 'Sistema',
            'email' => 'admin@vetnova.com',
            'password' => Hash::make('123456'),
            'direccion' => 'VetNova Clinic',
            'zona' => 'urbana',
            'telefono' => '3000000000',
            'rol' => 'admin', 
            'estado' => 'Activo'
        ]);

        User::create([
            'dni' => '100000002',
            'nombre' => 'Carlos',
            'apellido' => 'Doctor',
            'email' => 'doctor@vetnova.com',
            'password' => Hash::make('123456'),
            'direccion' => 'Clinica',
            'zona' => 'urbana',
            'telefono' => '3000000001',
            'rol' => 'doctor',
            'estado' => 'Activo'
        ]);

        User::create([
            'dni' => '100000003',
            'nombre' => 'Laura',
            'apellido' => 'Recepcion',
            'email' => 'recep@vetnova.com',
            'password' => Hash::make('123456'),
            'direccion' => 'Clinica',
            'zona' => 'urbana',
            'telefono' => '3000000002',
            'rol' => 'recepcionista',
            'estado' => 'Activo'
        ]);

        User::create([
            'dni' => '100000004',
            'nombre' => 'Pedro',
            'apellido' => 'Cliente',
            'email' => 'cliente14@vetnova.com',
            'password' => Hash::make('123456'),
            'direccion' => 'Bogotá',
            'zona' => 'urbana',
            'telefono' => '3000000003',
            'rol' => 'cliente',
            'estado' => 'Activo'
        ]);

        User::create([
            'dni' => '100000005',
            'nombre' => 'Camila',
            'apellido' => 'Cliente',
            'email' => 'cliente5@vetnova.com',
            'password' => Hash::make('123456'),
            'direccion' => 'Bogotá',
            'zona' => 'urbana',
            'telefono' => '3000000003',
            'rol' => 'cliente',
            'estado' => 'Activo'
        ]);

        User::create([
            'dni' => '100000006',
            'nombre' => 'Alejandro',
            'apellido' => 'Cliente',
            'email' => 'cliente6@vetnova.com',
            'password' => Hash::make('123456'),
            'direccion' => 'Bogotá',
            'zona' => 'urbana',
            'telefono' => '3000000003',
            'rol' => 'cliente',
            'estado' => 'Activo'
        ]);
    }
}
