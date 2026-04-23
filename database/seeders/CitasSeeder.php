<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Cita;
use App\Models\User;
use App\Models\Mascota;
use Carbon\Carbon;


class CitasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clientes = User::where('rol', 'cliente')->get();
        $doctores = User::where('rol', 'doctor')->get();

        if ($clientes->isEmpty() || $doctores->isEmpty()) {
            $this->command->warn('No hay clientes o doctores para generar citas.');
            return;
        }

        $horas = ['08:00', '08:30', '09:00', '09:30', '10:00', '10:30'];

        foreach ($clientes as $cliente) {

            // Obtener mascotas del cliente
            $mascotas = Mascota::where('cliente_id', $cliente->id)->get();

            if ($mascotas->isEmpty()) continue;

            foreach ($mascotas as $mascota) {

                // Generar entre 1 y 2 citas por mascota
                for ($i = 0; $i < rand(1, 2); $i++) {

                    $doctor = $doctores->random();
                    $fecha = Carbon::now()->addDays(rand(1, 5))->toDateString();
                    $hora = $horas[array_rand($horas)];

                    // Evitar duplicados
                    $existe = Cita::where('doctor_id', $doctor->id)
                        ->where('fecha_cita', $fecha)
                        ->where('hora_cita', $hora)
                        ->exists();

                    if ($existe) continue;

                    Cita::create([
                        'cliente_id' => $cliente->id,
                        'mascota_id' => $mascota->id,
                        'doctor_id' => $doctor->id,
                        'motivo' => 'Consulta general',
                        'fecha_solicitud' => Carbon::now(),
                        'fecha_cita' => $fecha,
                        'hora_cita' => $hora,
                        'estado' => 'pendiente',
                    ]);
                }
            }
        }
    }
}
