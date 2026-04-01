<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Mascota;
use App\Models\User;

class MascotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener solo usuarios con rol cliente
        $clientes = User::where('rol', 'cliente')->pluck('id');

        if ($clientes->isEmpty()) {
            $this->command->warn('No hay usuarios tipo cliente para asignar mascotas.');
            return;
        }

        Mascota::create([
            'nombre' => 'Max',
            'edad' => 3,
            'genero' => 'macho',
            'especie' => 'Perro',
            'cliente_id' => $clientes->random(),
        ]);

        Mascota::create([
            'nombre' => 'Luna',
            'edad' => 2,
            'genero' => 'hembra',
            'especie' => 'Gato',
            'cliente_id' => $clientes->random(),
        ]);

        Mascota::create([
            'nombre' => 'Rocky',
            'edad' => 5,
            'genero' => 'macho',
            'especie' => 'Perro',
            'cliente_id' => $clientes->random(),
        ]);

        Mascota::create([
            'nombre' => 'Milo',
            'edad' => 1,
            'genero' => 'macho',
            'especie' => 'Gato',
            'cliente_id' => $clientes->random(),
        ]);
    }
}
