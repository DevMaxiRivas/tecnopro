<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleComprasController;
use App\Http\Controllers\DetalleOrdenCompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleController;

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
    Route::resource('/compras', CompraController::class)->names('compras');
    Route::get('/compras/pdf/{compra}', [CompraController::class, 'pdf'])->name('compras.pdf');

    // Detalle de Compra
    Route::get('/detalle-orden-compra/{id_compra}/agregar', [DetalleOrdenCompraController::class, 'agregarProductos'])->name('detalle-orden-compra.agregar');
    Route::post('/detalle-orden-compra/guardar', [DetalleOrdenCompraController::class, 'guardarDetallesCompras'])->name('detalle-orden-compra.guardar');
    Route::resource('/detalle-orden-compra/{id_compra}', DetalleOrdenCompraController::class)->names('detalle-orden-compra');
});



