<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProveedorResource;
use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Proveedor::query();
        
        if($request->search){
            $query-> where('nombre', 'like', '%'.$request->search.'%');
        }

        $proveedores = $query-> paginate(10);

        return ProveedorResource::collection($proveedores);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $proveedor = Proveedor::findOrFail($request->validate());

        return new ProveedorResource($proveedor);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $proveedor = Proveedor::findOrFail($id);

        return new ProveedorResource($proveedor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $proveedor = Proveedor::findOrFail($id);
        $proveedor->update($request->validate());

        return new ProveedorResource($proveedor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $proveedor = Proveedor::findOfFail($id);
        $proveedor-> delete();

        return response()->json([
            'message' => 'Proveedor eliminado correctamente'
        ]);
    }
}
