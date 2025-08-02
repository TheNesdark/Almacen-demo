<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Fabricante;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::with('fabricante')->get();
        $fabricantes = Fabricante::orderBy('nombre')->get();
        
        return view('productos.index', compact('productos', 'fabricantes'));
    }

    public function store(ProductoRequest $request)
    {
        Producto::create($request->validated());
        return redirect()->route('productos.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        
        return redirect()->route('productos.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }
}