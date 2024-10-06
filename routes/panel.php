<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleComprasController;
use App\Http\Controllers\DetalleOrdenCompraController;
use App\Http\Controllers\ProductoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.index');
})->name('panel');

// Grupo de rutas para usuarios con Rol Admin y Empleado de Compras
Route::group(['middleware' => ['role:admin|empleado_compras']], function () {
    // Categorias
    Route::resource('/categorias', CategoriaController::class)->names('categoria');

    // Productos
    Route::resource('/productos', ProductoController::class)->names('producto');
    // Route::get('/productos/categoria', [ProductoController::class, 'obtenerProductosPorCategoria'])->name('obtener-productos-por-categoria');

    // Detalle de Compra
    Route::get('/detalle-orden-compra/{id_compra}/agregar', [DetalleOrdenCompraController::class, 'agregarProductos'])->name('detalle-orden-compra.agregar');
    Route::resource('/detalle-orden-compra/{id_compra}', DetalleOrdenCompraController::class)->names('detalle-orden-compra');
});
