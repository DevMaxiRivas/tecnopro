<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function() {
    return view('panel.index');
});
Route::resource('/categorias', CategoriaController::class)->names('categoria');
Route::resource('/productos', ProductoController::class)->names('producto');

<<<<<<< HEAD
=======

Route::resource('/categorias', CategoriaController::class)->names('categoria');
Route::resource('/productos', ProductoController::class)->names('producto');
>>>>>>> a792bed8e172c8acb0a4996013a2be374639c03c
