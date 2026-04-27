<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Receta;
use App\Models\RecetaDetalle;
use App\Models\Cita;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\RecetaRequest;
use App\Http\Resources\RecetaResource;

class RecetaController extends Controller
{
    public function store(RecetaRequest $request)
    {
        DB::beginTransaction();

        try {

            $cita = Cita::findOrFail($request->cita_id);

            $receta = Receta::create([
                'cita_id' => $cita->id,
                'doctor_id' => $cita->doctor_id,
                'cliente_id' => $cita->cliente_id,
                'mascota_id' => $cita->mascota_id,
                'observaciones' => $request->observaciones,
                'fecha' => now(),
            ]);

            foreach ($request->detalles as $detalle) {

                RecetaDetalle::create([
                    'receta_id' => $receta->id,
                    'tipo' => $detalle['tipo'],
                    'producto_id' => $detalle['producto_id'] ?? null,
                    'descripcion' => $detalle['descripcion'] ?? null,
                    'cantidad' => $detalle['cantidad'] ?? null,
                    'precio' => isset($detalle['producto_id'])
                        ? \App\Models\Producto::find($detalle['producto_id'])->precio_venta
                        : null
                ]);
            }

            DB::commit();

            return new RecetaResource($receta->load('detalles.producto', 'cliente', 'mascota', 'doctor'));

        } catch (\Exception $e) {

            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
