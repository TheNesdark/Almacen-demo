<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\FabricanteResource;
use App\Models\Fabricante;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class FabricanteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fabricantes = Fabricante::with('productos')->paginate(15);
        
        return FabricanteResource::collection($fabricantes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'nombre' => 'required|string|max:255|unique:fabricantes',
                'sector' => 'required|string|max:255',
            ]);

            $fabricante = Fabricante::create($validated);

            return new FabricanteResource($fabricante);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fabricante = Fabricante::with('productos')->findOrFail($id);
        
        return new FabricanteResource($fabricante);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $fabricante = Fabricante::findOrFail($id);
            
            $validated = $request->validate([
                'nombre' => 'required|string|max:255|unique:fabricantes,nombre,' . $id,
                'sector' => 'required|string|max:255',
            ]);

            $fabricante->update($validated);

            return new FabricanteResource($fabricante);
        } catch (ValidationException $e) {
            return response()->json([
                'message' => 'Error de validación',
                'errors' => $e->errors()
            ], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $fabricante = Fabricante::findOrFail($id);
        
        // Verificar si tiene productos asociados
        if ($fabricante->productos()->count() > 0) {
            return response()->json([
                'message' => 'No se puede eliminar el fabricante porque tiene productos asociados'
            ], 409);
        }
        
        $fabricante->delete();

        return response()->json([
            'message' => 'Fabricante eliminado correctamente'
        ]);
    }
}
