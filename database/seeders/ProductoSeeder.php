<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Producto;
use App\Models\Fabricante;

class ProductoSeeder extends Seeder
{
    public function run(): void
    {
        $fabricantes = Fabricante::all();

        $productos = [
            [
                'nombre' => 'iPhone 15 Pro',
                'descripcion' => 'Smartphone premium con chip A17 Pro y cámara de 48MP',
                'precio' => 999.99,
                'stock' => 25,
                'categoria' => 'Electrónicos',
                'fabricante_id' => $fabricantes->where('nombre', 'Apple')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Galaxy S24 Ultra',
                'descripcion' => 'Smartphone Android con S Pen y cámara de 200MP',
                'precio' => 1199.99,
                'stock' => 15,
                'categoria' => 'Electrónicos',
                'fabricante_id' => $fabricantes->where('nombre', 'Samsung')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Air Jordan 1',
                'descripcion' => 'Zapatillas deportivas clásicas de basketball',
                'precio' => 170.00,
                'stock' => 50,
                'categoria' => 'Deportes',
                'fabricante_id' => $fabricantes->where('nombre', 'Nike')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Ultraboost 22',
                'descripcion' => 'Zapatillas de running con tecnología Boost',
                'precio' => 180.00,
                'stock' => 30,
                'categoria' => 'Deportes',
                'fabricante_id' => $fabricantes->where('nombre', 'Adidas')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Corolla Hybrid',
                'descripcion' => 'Sedán híbrido eficiente y confiable',
                'precio' => 25000.00,
                'stock' => 5,
                'categoria' => 'Otros',
                'fabricante_id' => $fabricantes->where('nombre', 'Toyota')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Mustang GT',
                'descripcion' => 'Muscle car americano con motor V8',
                'precio' => 45000.00,
                'stock' => 3,
                'categoria' => 'Otros',
                'fabricante_id' => $fabricantes->where('nombre', 'Ford')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Coca-Cola 355ml',
                'descripcion' => 'Refresco de cola clásico en lata',
                'precio' => 1.50,
                'stock' => 200,
                'categoria' => 'Otros',
                'fabricante_id' => $fabricantes->where('nombre', 'Coca-Cola')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'KitKat 4 Fingers',
                'descripcion' => 'Chocolate con galleta crujiente',
                'precio' => 2.99,
                'stock' => 100,
                'categoria' => 'Otros',
                'fabricante_id' => $fabricantes->where('nombre', 'Nestlé')->first()?->id ?? $fabricantes->first()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Camiseta Básica',
                'descripcion' => 'Camiseta de algodón 100% en varios colores',
                'precio' => 19.99,
                'stock' => 75,
                'categoria' => 'Ropa',
                'fabricante_id' => $fabricantes->random()->id,
                'activo' => true
            ],
            [
                'nombre' => 'Laptop Gaming',
                'descripcion' => 'Laptop para gaming con RTX 4060 y 16GB RAM',
                'precio' => 1299.99,
                'stock' => 8,
                'categoria' => 'Electrónicos',
                'fabricante_id' => $fabricantes->random()->id,
                'activo' => true
            ]
        ];

        foreach ($productos as $producto) {
            Producto::create($producto);
        }
    }
}