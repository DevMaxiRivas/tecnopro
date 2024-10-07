<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ProveedorController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
})->name('panel');


Route::resource('/categorias', CategoriaController::class)->names('categoria');
Route::resource('/productos', ProductoController::class)->names('producto');
Route::resource('/proveedor', ProveedorController::class)->names('proveedor');