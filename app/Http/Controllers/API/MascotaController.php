<?php

namespace App\Http\Controllers\Api;

use App\Models\Mascota;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\MascotaResource;

class MascotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Mascota::with('cliente');

        if($request->search){
            $query->where('nombre', 'like', '%' . $request->search . '%');
        }

        $mascotas = $query->paginate(10);

        return MascotaResource::collection($mascotas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mascota = Mascota::create($request->validated());

        return new MascotaResource($mascota);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mascota = Mascota::with('cliente')->findOrFail($id);

        return new MascotaResource($mascota);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->update($request->validated());

        return new MascotaResource($mascota);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mascota = Mascota::findOrFail($id);
        $mascota->delete();

        return response()->json([
            'message' => 'Mascota eliminada'
        ]);
    }
}
