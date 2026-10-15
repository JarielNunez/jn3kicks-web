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
    ['nombre' => 'Nike Free Metcon 7', 'precio' => 8800, 'imagen' => 'img/productos/nike_free_metcon_7.png', 'categoria' => 'training', 'marca' => 'nike', 'genero' => 'unisex', 'stock' => 12],
    ['nombre' => 'Ja Morant 4 "Phantom"', 'precio' => 9500, 'imagen' => 'img/productos/ja_4_phantom.png', 'categoria' => 'basketball', 'marca' => 'nike', 'genero' => 'hombre', 'stock' => 8],
    ['nombre' => 'Nike Air Max 270', 'precio' => 11490, 'imagen' => 'img/productos/air_max_270.png', 'categoria' => 'training', 'marca' => 'nike', 'genero' => 'hombre', 'stock' => 19],
    ['nombre' => 'Nike Pegasus Plus 2', 'precio' => 11490, 'imagen' => 'img/productos/nike_pegasus_plus_2.png', 'categoria' => 'training', 'marca' => 'nike', 'genero' => 'hombre', 'stock' => 24],
    ['nombre' => 'Nike Vomero Premium', 'precio' => 15890, 'imagen' => 'img/productos/nike_vomero_premium.png', 'categoria' => 'running', 'marca' => 'nike', 'genero' => 'hombre', 'stock' => 60],
    ['nombre' => 'Nike Hybrid RN', 'precio' => 10000, 'imagen' => 'img/productos/nike_hybrid_women.png', 'categoria' => 'training', 'marca' => 'nike', 'genero' => 'mujer', 'stock' => 34],
];

foreach ($productos as $producto) {
    Producto::create($producto);
}
    }
}
