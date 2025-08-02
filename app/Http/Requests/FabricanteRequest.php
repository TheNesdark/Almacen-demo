<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FabricanteRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $fabricanteId = optional($this->route('fabricante'))->id;
        
        return [
            'nombre' => 'required|string|max:255|unique:fabricantes,nombre,' . $fabricanteId,
            'sector' => 'required|string|'
        ];
    }

    public function messages(): array
    {
        return [
            'nombre.required' => 'El nombre es obligatorio',
            'nombre.string' => 'El nombre debe ser un texto',
            'nombre.max' => 'El nombre no puede tener más de 255 caracteres',
            'nombre.unique' => 'Ya existe un fabricante con ese nombre',
            'sector.required' => 'El sector es obligatorio',
            'sector.string' => 'El sector debe ser un texto',
            'sector.in' => 'El sector seleccionado no es válido'
        ];
    }
}
