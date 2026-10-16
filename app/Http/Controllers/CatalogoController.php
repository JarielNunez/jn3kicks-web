<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\View\View;

class CatalogoController extends Controller
{
    /**
     * Mostrar todos los productos del catálogo.
     */
    public function index(): View
    {
        $productos = Producto::all();

        return view('catalogo.index', compact('productos'));
    }

    /**
     * Mostrar los detalles de un producto.
     */
    public function show(Producto $producto): View
    {
        return view('catalogo.show', compact('producto'));
    }
}