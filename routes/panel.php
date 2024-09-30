<?php

// Rutas del Panel de Administracion

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function() {
    return view('panel.index');
});


Route::resource('/categorias', CategoriaController::class)->names('categoria');