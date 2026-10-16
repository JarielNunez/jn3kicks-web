<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductoRequest;
use App\Models\Producto;
use Illuminate\Database\QueryException;

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

    public function store(ProductoRequest $request)
    {
        Producto::create($request->validated());

        return redirect()->route('admin.productos.index')
            ->with('exito', 'Producto creado correctamente.');
    }

    public function edit(Producto $producto)
    {
        return view('admin.productos.edit', ['producto' => $producto]);
    }

    public function update(ProductoRequest $request, Producto $producto)
    {
        $producto->update($request->validated());

        return redirect()->route('admin.productos.index')
            ->with('exito', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        try {
            $producto->delete();
        } catch (QueryException $e) {
            return redirect()->route('admin.productos.index')
                ->with('error', 'No se puede eliminar: tiene pedidos');
        }

        return redirect()->route('admin.productos.index')
            ->with('exito', 'Producto eliminado correctamente.');
    }
}
