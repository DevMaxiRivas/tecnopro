<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
})->name('panel');

// Grupo de rutas para usuarios con Rol Admin y Empleado de Compras
Route::group(['middleware' => ['role:admin|empleado_compras']], function () {
    Route::resource('/categorias', CategoriaController::class)->names('categoria');
    Route::resource('/productos', ProductoController::class)->names('producto');
});
