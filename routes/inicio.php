<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\InicioController;

Route::get('/', [InicioController::class, 'index'])->name('inicio');
Route::get('/nosotros', [InicioController::class, 'nosotros'])->name('nosotros');
Route::get('/contacto', [InicioController::class, 'contacto'])->name('contacto');