<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleComprasController;
use App\Http\Controllers\DetalleOrdenCompraController;
use App\Http\Controllers\DetalleVentaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaController;
use App\Models\Venta;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.index');
})->name('panel');

// Grupo de rutas para usuarios con Rol Admin y Empleado de Compras
Route::group(['middleware' => ['role:admin|empleado_compras']], function () {
    // Categorias
    Route::resource('/categorias', CategoriaController::class)->names('categoria');

    //Proveedores 
    Route::resource('/proveedor', ProveedorController::class)->names('proveedor'); 

    // Productos
    Route::resource('/productos', ProductoController::class)->names('producto');
    Route::resource('/compras', CompraController::class)->names('compras');
    Route::get('/compras/pdf/{compra}', [CompraController::class, 'pdf'])->name('compras.pdf');

    // Detalle de Compra
    Route::get('/detalle-orden-compra/{id_compra}/agregar', [DetalleOrdenCompraController::class, 'agregarProductos'])->name('detalle-orden-compra.agregar');
    Route::get('/detalle-orden-compra/{id_compra}', [DetalleOrdenCompraController::class, 'index'])->name('detalle-orden-compra.index');
    // Rutas para detalle de compra
    // Route::get('/detalle-orden-compra/{orden_compra}/agregar', [DetalleOrdenCompraController::class, 'agregarProductos'])->name('detalle-orden-compra.agregar');
    // Route::resource('/detalle-orden-compra', DetalleOrdenCompraController::class)->names('detalle-orden-compra');

    Route::post('/detalle-orden-compra/guardar', [DetalleOrdenCompraController::class, 'guardarDetallesCompras'])->name('detalle-orden-compra.guardar');

    // Ventas
    Route::resource('/ventas', VentaController::class)->names('ventas');
    Route::get('/detalle_venta/{id_venta}', [DetalleVentaController::class, 'index'])->name('detalle_venta.index');
    Route::get('/ventas/pdf/{venta}', [VentaController::class, 'pdf'])->name('ventas.pdf');
});



