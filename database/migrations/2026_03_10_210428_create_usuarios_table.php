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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            $table->string('dni')->unique();
            $table->string('nombre');
            $table->string('apellido');

            $table->string('email')->unique();
            $table->string('password');

            $table->string('direccion')->nullable();
            $table->string('zona')->nullable();

            $table->string('telefono');
            $table->string('telefono_alt')->nullable();

            $table->enum('rol', [
                'admin',
                'doctor',
                'recepcionista',
                'cliente'
            ])->default('cliente');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
