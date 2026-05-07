<?php

namespace App\Http\Controllers\Api;

use App\Models\Categoria;
use App\Http\Requests\CategoriaRequest;
use App\Http\Resources\CategoriaResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $query = Categoria::where('estado', 'Activo');

        if($request->search){
            $query->where('nombre', 'like', '%'.$request->search.'%');
        }

        $categorias = $query->paginate(10);
        return CategoriaResource::collection($categorias);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoriaRequest $request)
    {
        $categoria = Categoria::create($request->validated());
        $categoria->refresh();
        return new CategoriaResource($categoria);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $categoria = Categoria::where('estado', 'Activo')
            ->where('id', $id)
            ->firstOrFail();
        return new CategoriaResource($categoria);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoriaRequest $request, string $id)
    {
        $categoria = Categoria::where('estado', 'Activo')
            ->where('id', $id)
            ->firstOrFail();
        $categoria->update($request->validated());
        return new CategoriaResource($categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categoria = Categoria::where('estado', 'Activo')
            ->where('id', $id)
            ->firstOrFail();

        $categoria->update([
            'estado' => 'Inactivo'
        ]);

        return response()->json([
            'message' => 'Categoría eliminada correctamente'
        ]);
    }
}
