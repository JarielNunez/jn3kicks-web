<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class InicioController extends Controller
{
    public function index()
    {
        $destacados = Producto::orderByDesc('id')->take(4)->get();
        return view('inicio', compact('destacados'));
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