<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Usuario;

class CarritoController extends Controller
{
    public function index()
    {
        //TEMPORAL: usuario demo hasta que este el login de Joshua. Luego: Auth::id()
        $usuarioId = Usuario::where('correo', 'demo@jn3kicks.com')->value('id');

        $articulos = Carrito::with('producto')
        ->where('usuario_id', $usuarioId)
        ->get();

        return $articulos; //TEMPORAL: para probar antes de tener la vista
    }
}
