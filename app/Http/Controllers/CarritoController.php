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
        $usuarioId = $this->usuarioActualId();

        $articulos = Carrito::with('producto')
        ->where('usuario_id', $usuarioId)
        ->get();

        return view('carrito', compact('articulos')); 
    }

    public function update(Request $request, Carrito $carrito)
{
    abort_if($carrito->usuario_id != $this->usuarioActualId(), 403);

    $datos = $request->validate([
        'cantidad' => 'required|integer|min:1|max:99',
    ]);

    $carrito->update($datos);

    return response()->json(['exito' => true]);
}

public function destroy(Carrito $carrito)
{
    abort_if($carrito->usuario_id != $this->usuarioActualId(), 403);

    $carrito->delete();

    return response()->json(['exito' => true]);
}

private function usuarioActualId()
{
    // TEMPORAL: usuario demo hasta que esté el login de Joshua. Luego: return Auth::id();
    return Usuario::where('correo', 'demo@jn3kicks.com')->value('id');
}
}
