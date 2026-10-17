<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;

Route::get('/catalogo', [ProductoController::class, 'index'])
    ->name('catalogo.index');

Route::get('/producto/{producto}', [ProductoController::class, 'show'])
    ->name('producto.show');