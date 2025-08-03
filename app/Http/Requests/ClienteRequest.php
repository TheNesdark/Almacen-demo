<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClienteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $clienteId = $this->route('cliente')?->id ?? 'NULL';
        
        return [
            "nombre" => ["required", "string", "min:2", "max:100"],
            "apellido" => ["required", "string", "min:2", "max:100"],
            "telefono" => ["nullable", "string", "max:20"],
            "correo" => ["required", "email", "max:100", "unique:clientes,correo,$clienteId"],
            "pais" => ["nullable", "string", "max:100"],
            "ciudad" => ["nullable", "string", "max:100"],
        ];
    }
    
    public function messages(): array
{
    return [
        'nombre.required' => 'El nombre es obligatorio.',
        'nombre.min' => 'El nombre debe tener al menos 2 caracteres.',
        'apellido.required' => 'El apellido es obligatorio.',
        'apellido.min' => 'El apellido debe tener al menos 2 caracteres.',
        'correo.required' => 'El correo electrónico es obligatorio.',
        'correo.email' => 'El correo debe tener un formato válido.',
        'correo.unique' => 'Este correo ya está registrado.',
    ];
}

}
