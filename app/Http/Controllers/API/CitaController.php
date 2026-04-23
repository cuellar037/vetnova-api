<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CitaRequest;
use App\Http\Resources\CitaResource;
use App\Models\Cita;
use Illuminate\Support\Carbon;  

class CitaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Cita::with(['cliente', 'mascota', 'doctor']);

        if($request->fecha){
            $query->where('fecha_cita', $request->fecha);
        }

        $citas = $query->paginate(10);
        return CitaResource::collection($citas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CitaRequest $request)
    {
        $data = $request->validated();
        $data['estado'] = $data['estado'] ?? 'pendiente';
        $data['fecha_solicitud'] = Carbon::now();
        $cita = Cita::create($data);
        return new CitaResource($cita);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cita = Cita::with(['cliente', 'mascota', 'doctor'])->findOrFail($id);
        return new CitaResource($cita);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->update($request->validated());
        return new CitaResource($cita);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cita = Cita::findOrFail($id);
        $cita->delete();
        return response()->json(['message' => 'Cita eliminada']);
    }
}
