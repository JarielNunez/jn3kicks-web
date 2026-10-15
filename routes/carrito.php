<?php

use App\Http\Controllers\CarritoController;
use Illuminate\Support\Facades\Route;

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
