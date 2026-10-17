<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Carrito;
use App\Models\Producto;
use App\Models\Usuario;

class CarritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
   
            $demoId= Usuario::where('correo', 'demo@jn3kicks.com')->value('id');
            $productos = Producto::take(2)->pluck('id');

            Carrito::create(['usuario_id' => $demoId, 'producto_id' => $productos[0], 'cantidad' =>1]);
            Carrito::create(['usuario_id' => $demoId, 'producto_id' => $productos[1], 'cantidad' =>2]);
        
    }
}
