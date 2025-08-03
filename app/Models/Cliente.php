<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    public $timestamps = true;
    protected $fillable = [
        'nombre',
        'apellido',
        'telefono',
        'correo',
        'ciudad',
        'pais',
    ];

    
    public function GetNombreCompleto()
    {
        return $this->nombre . " " . $this->apellido;
    
    }

    public function GetUbicacion()
    {
        return $this->ciudad . " - " . $this->pais;

    }

}
