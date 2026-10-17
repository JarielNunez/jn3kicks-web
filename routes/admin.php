<?php

use App\Http\Controllers\Admin\ProductoController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('productos', ProductoController::class)->except('show');
});