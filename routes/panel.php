<?php

// Rutas del Panel de Administracion

use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function() {
    return view('panel.index');
});

<<<<<<< HEAD

Route::resource('/categorias', CategoriaController::class)->names('categoria');
=======
Route::resource('/productos', ProductoController::class)->names('producto');
>>>>>>> e978365f6b8b682387c9ba9ce7bd32dc91c4a7c4
