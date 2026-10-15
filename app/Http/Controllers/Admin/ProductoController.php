<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::orderByDesc('id')->get();
        return view('admin.productos.index', ['productos' => $productos]);
    }

    public function create()
    {
        return view('admin.productos.create');
    }

    public function store(Request $request)
    {
        // pendiente: validar y guardar
        return redirect()->route('admin.productos.index');
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', ['producto' => $producto]);
    }

    public function update(Request $request, Producto $producto)
    {
        // pendiente: validar y actualizar
        return redirect()->route('admin.productos.index');
    }

    public function destroy(Producto $producto)
    {
        // pendiente: eliminar
        return redirect()->route('admin.productos.index');
    }
}