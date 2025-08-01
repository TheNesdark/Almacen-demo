<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fabricante;

class FabricanteSeeder extends Seeder
{
    public function run(): void
    {
        $fabricantes = [
            ['nombre' => 'Toyota', 'sector' => 'Automotriz'],
            ['nombre' => 'Samsung', 'sector' => 'Electrónica'],
            ['nombre' => 'Nestlé', 'sector' => 'Alimentación'],
            ['nombre' => 'Nike', 'sector' => 'Textil'],
            ['nombre' => 'Apple', 'sector' => 'Electrónica'],
            ['nombre' => 'Coca-Cola', 'sector' => 'Alimentación'],
            ['nombre' => 'Ford', 'sector' => 'Automotriz'],
            ['nombre' => 'Adidas', 'sector' => 'Textil'],
        ];

        foreach ($fabricantes as $fabricante) {
            Fabricante::create($fabricante);
        }
    }
}