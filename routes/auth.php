<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// Muestra el formulario de login
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');

// Procesa el inicio de sesión
Route::post('/login', [AuthController::class, 'login']);
