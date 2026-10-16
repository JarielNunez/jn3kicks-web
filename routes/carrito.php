<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
    Route::patch('/carrito/{carrito}', [CarritoController::class, 'update'])->name('carrito.update');
    Route::delete('/carrito/{carrito}', [CarritoController::class, 'destroy'])->name('carrito.destroy');
});