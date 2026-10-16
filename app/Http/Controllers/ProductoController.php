<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\View\View;

class ProductoController extends Controller
{
    public function index(): View
    {
        $productos = Producto::query()
            ->orderBy('nombre')
            ->get();

        return view('catalogo.index', compact('productos'));
    }

    public function show(Producto $producto): View
    {
        return view('catalogo.show', compact('producto'));
    }
}