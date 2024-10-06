<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\RegProveedorController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleController;

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
})->name('panel');


Route::resource('/categorias', CategoriaController::class)->names('categoria');
Route::resource('/productos', ProductoController::class)->names('producto');
Route::resource('/regproveedor', RegProveedorController::class)->names('regproveedor');
Route::resource('/compras', CompraController::class)->names('compras');
