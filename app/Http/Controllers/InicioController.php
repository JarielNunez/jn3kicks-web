<?php

namespace App\Http\Controllers;

use App\Models\Producto;

class InicioController extends Controller
{
    public function index()
    {

    $principal = Producto::where('es_principal', true)->first()
        ?? Producto::orderByDesc('precio')->first();

    $destacados = Producto::where('destacado', true)
        ->where('id', '!=', $principal->id)
        ->take(4)
        ->get();

    if ($destacados->isEmpty()) {
        $destacados = Producto::where('id', '!=', $principal->id)->latest('id')->take(4)->get();
    }
    $banner = Producto::where('id', '!=', $principal->id)
    ->whereNotIn('id', $destacados->pluck('id'))
    ->first()
    ?? Producto::where('id', '!=', $principal->id)->orderByDesc('precio')->first();

    $banner = Producto::where('id', '!=', $principal->id)
        ->whereNotIn('id', $destacados->pluck('id'))
        ->first()
        ?? Producto::where('id', '!=', $principal->id)->orderByDesc('precio')->first();

return view('inicio', compact('principal', 'destacados', 'banner'));
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