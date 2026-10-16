<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class InicioController extends Controller
{
    public function index()
    {


    // TEMPORAL: hasta que JeanMarcos agregue es_principal y destacado
    $principal = Producto::orderByDesc('precio')->first();

    $destacados = Producto::where('id', '!=', $principal->id)
        ->latest('id')
        ->take(4)
        ->get();

    return view('inicio', compact('principal', 'destacados'));

    }

    public function nosotros()
    {
        return view('nosotros');
    }

    public function contacto()
    {
        return view('contacto');
    }
}