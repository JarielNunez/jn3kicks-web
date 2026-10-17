<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\Usuario;
use Illuminate\Support\Facades\Auth;

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

    public function store(Request $request)
{
    $datos = $request->validate([
        'producto_id' => 'required|exists:productos,id',
    ]);

    $articulo = Carrito::firstOrNew([
        'usuario_id'  => $this->usuarioActualId(),
        'producto_id' => $datos['producto_id'],
    ]);

    $articulo->cantidad = ($articulo->cantidad ?? 0) + 1;
    $articulo->save();

    return redirect()->route('carrito.index');
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
    return Auth::id();
}
}
