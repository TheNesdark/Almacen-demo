<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $productoId = optional($this->route('producto'))->id;
        
        return [
            'nombre' => 'required|string|max:150|unique:productos,nombre,' . $productoId,
            'descripcion' => 'nullable|string|max:1000',
            'precio' => 'required|numeric|min:0|max:999999.99',
            'stock' => 'required|integer|min:0|max:999999',
            'categoria' => 'required|string|in:Electrónicos,Ropa,Hogar,Deportes,Libros,Otros',
            'fabricante_id' => [
                'required',
                'integer',
                'exists:fabricantes,id'
            ],
            'activo' => 'boolean'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre del producto es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto',
            'nombre.max' => 'El nombre no puede tener más de 150 caracteres',
            'nombre.unique' => 'Ya existe un producto con ese nombre',
            
            'descripcion.string' => 'La descripción debe ser un texto',
            'descripcion.max' => 'La descripción no puede tener más de 1000 caracteres',
            
            'precio.required' => 'El precio es obligatorio',
            'precio.numeric' => 'El precio debe ser un número',
            'precio.min' => 'El precio no puede ser negativo',
            'precio.max' => 'El precio es demasiado alto',
            
            'stock.required' => 'El stock es obligatorio',
            'stock.integer' => 'El stock debe ser un número entero',
            'stock.min' => 'El stock no puede ser negativo',
            'stock.max' => 'El stock es demasiado alto',
            
            'categoria.required' => 'La categoría es obligatoria',
            'categoria.in' => 'La categoría seleccionada no es válida',
            
            'fabricante_id.required' => 'El fabricante es obligatorio',
            'fabricante_id.integer' => 'El fabricante debe ser un número válido',
            'fabricante_id.exists' => 'El fabricante seleccionado no existe',
            
            'activo.boolean' => 'El estado debe ser verdadero o falso'
        ];
    }

    public function prepareForValidation()
    {
        // Manejar checkbox activo correctamente
        $this->merge([
            'activo' => $this->has('activo') ? true : false
        ]);
    }
}

