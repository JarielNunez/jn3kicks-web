<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::patch('/carrito/{carrito}', [CarritoController::class, 'update'])->name('carrito.update');
Route::delete('/carrito/{carrito}', [CarritoController::class, 'destroy'])->name('carrito.destroy');