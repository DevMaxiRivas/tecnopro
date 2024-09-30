<?php

// Rutas del Panel de Administracion

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
});

Route::resource('/productos', ProductoController::class)->names('producto');