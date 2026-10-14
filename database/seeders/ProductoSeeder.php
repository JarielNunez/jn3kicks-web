<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Producto;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $productos = [
    ['nombre' => 'Nike Ja 4', 'precio' => 2500, 'imagen' => 'img/productos/nike-ja-4.jpg', 'categoria' => 'basketball', 'marca' => 'nike', 'genero' => 'unisex', 'stock' => 15],
    ['nombre' => 'Nike Giannis Immortality 5', 'precio' => 3500, 'imagen' => 'img/productos/nike-giannis-immortality-5.jpg', 'categoria' => 'basketball', 'marca' => 'nike', 'genero' => 'unisex', 'stock' => 10],
    ['nombre' => 'Nike ZoomX Vaporfly Next% 3', 'precio' => 9500, 'imagen' => 'img/productos/nike-zoomx-vaporfly-next-3.png', 'categoria' => 'running', 'marca' => 'nike', 'genero' => 'unisex', 'stock' => 8],
    ['nombre' => 'Nike Air Max', 'precio' => 5500, 'imagen' => 'img/productos/nike-air-max.png', 'categoria' => 'casual', 'marca' => 'nike', 'genero' => 'hombre', 'stock' => 12],
    ['nombre' => 'Converse Chuck 70', 'precio' => 4800, 'imagen' => 'img/productos/converse-chuck-70.png', 'categoria' => 'casual', 'marca' => 'converse', 'genero' => 'unisex', 'stock' => 20],
    ['nombre' => 'Converse Chuck Taylor Lift Platform', 'precio' => 4500, 'imagen' => 'img/productos/converse-chuck-taylor-lift.png', 'categoria' => 'casual', 'marca' => 'converse', 'genero' => 'mujer', 'stock' => 14],
];

foreach ($productos as $producto) {
    Producto::create($producto);
}
    }
}
