<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuario;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Usuario::forceCreate(['nombre' => 'Administrador', 'correo' => 'admin@jn3kicks.com', 'contrasena' => 'Admin1234', 'rol' => 'admin']);
        Usuario::forceCreate(['nombre' => 'Cliente Demo', 'correo' => 'demo@jn3kicks.com', 'contrasena' => 'Demo1234', 'rol' => 'cliente']);
    }
}
