<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $clientes = [
            [
                'nombre' => 'Ana',
                'apellido' => 'Pérez',
                'correo' => 'ana.perez@test.com',
                'telefono' => '555-1111',
                'ciudad' => 'CDMX',
                'pais' => 'México'
            ],
            [
                'nombre' => 'Luis',
                'apellido' => 'González',
                'correo' => 'luis.gonzalez@test.com',
                'telefono' => '555-2222',
                'ciudad' => 'Guadalajara',
                'pais' => 'México'
            ],
            [
                'nombre' => 'Carmen',
                'apellido' => 'López',
                'correo' => 'carmen.lopez@test.com',
                'telefono' => "3117090876", 
                'ciudad' => 'Monterrey',
                'pais' => 'México'
            ]
        ];
        
        foreach ($clientes as $cliente) {
            Cliente::create($cliente);
        }
    }
}
