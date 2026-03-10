<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('citas', function (Blueprint $table) {

            $table->id();

            $table->foreignId('cliente_id')
                ->constrained('usuarios');

            $table->foreignId('mascota_id')
                ->constrained('mascotas');

            $table->foreignId('doctor_id')
                ->nullable()
                ->constrained('usuarios');

            $table->text('motivo');

            $table->date('fecha_solicitud');

            $table->date('fecha_cita')->nullable();
            $table->time('hora_cita')->nullable();

            $table->enum('estado',[
                'pendiente',
                'agendada',
                'cancelada',
                'finalizada'
            ])->default('pendiente');

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('citas');
    }
};
