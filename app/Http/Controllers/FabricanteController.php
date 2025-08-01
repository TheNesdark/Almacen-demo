<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Fabricante;

class FabricanteController extends Controller
{
    public function index()
    {
        $fabricantes = Fabricante::all();
        return view('fabricantes.index', compact('fabricantes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:fabricantes,nombre',
            'sector' => 'required|string|max:255'
        ]);

        Fabricante::create([
            'nombre' => $request->nombre,
            'sector' => $request->sector
        ]);

        return redirect()->route('fabricantes.index')
            ->with('success', 'Fabricante creado exitosamente.');
    }

    public function update(Request $request, $id)
    {
        $fabricante = Fabricante::findOrFail($id);
        
        $request->validate([
            'nombre' => 'required|string|max:255|unique:fabricantes,nombre,' . $id,
            'sector' => 'required|string|max:255'
        ]);

        $fabricante->update([
            'nombre' => $request->nombre,
            'sector' => $request->sector
        ]);

        return redirect()->route('fabricantes.index')
            ->with('success', 'Fabricante actualizado exitosamente.');
    }

    public function destroy($id)
    {
        $fabricante = Fabricante::findOrFail($id);
        $fabricante->delete();

        return redirect()->route('fabricantes.index')
            ->with('success', 'Fabricante eliminado exitosamente.');
    }
}
