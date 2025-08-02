<?php

namespace App\Http\Controllers;

use App\Models\Fabricante;
use App\Http\Requests\FabricanteRequest;

class FabricanteController extends Controller
{
    public function index()
    {
        $fabricantes = Fabricante::all();
        return view('fabricantes.index', compact('fabricantes'));
    }

    public function store(FabricanteRequest $request)
    {
        Fabricante::create($request->validated());
        
        return redirect()->route('fabricantes.index')
            ->with('success', 'Fabricante creado exitosamente.');
    }

    public function update(FabricanteRequest $request, Fabricante $fabricante)
    {
        $fabricante->update($request->validated());
        
        return redirect()->route('fabricantes.index')
            ->with('success', 'Fabricante actualizado exitosamente.');
    }

    public function destroy(Fabricante $fabricante)
    {
        $fabricante->delete();
        
        return redirect()->route('fabricantes.index')
            ->with('success', 'Fabricante eliminado exitosamente.');
    }
}
