<?php

// Rutas del Panel de Administracion
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\DetalleComprasController;
use App\Http\Controllers\DetalleOrdenCompraController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\DetalleController;
use App\Http\Controllers\DetalleVentaClienteController;
use App\Http\Controllers\FormaPagoController;
use App\Http\Controllers\ProveedorController;
use App\Http\Controllers\VentaClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\DetalleVentaController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('panel.index');
})->name('panel');

// Grupo de rutas para usuarios con Rol Admin y Empleado de Compras
Route::group(['middleware' => ['role:cliente']], function () {
    //Mis Compras
    Route::get('/miscompras', [VentaClienteController::class, 'index'])->name('ventas.cliente.index');
    Route::patch('/compras/{venta}/cancelar', [VentaclienteController::class, 'cancelar'])->name('ventas.cliente.cancelar');


    //Detalle de mis compras
    Route::get('/miscompras/detalle_ventas/{id_venta}', [DetalleVentaClienteController::class, 'index'])->name('detalle_ventas.index');
});
Route::group(['middleware' => ['role:admin|empleado_compras']], function () {
    // Categorias
    Route::resource('/categorias', CategoriaController::class)->names('categoria');

    //Proveedores 
    Route::resource('/proveedor', ProveedorController::class)->names('proveedor');

    //FormaPago
    Route::resource('/formapago', FormaPagoController::class)->names('formapago');

    // Productos
    Route::resource('/productos', ProductoController::class)->names('producto');
    Route::resource('/compras', CompraController::class)->names('compras');
    Route::get('/compras/pdf/{compra}', [CompraController::class, 'pdf'])->name('compras.pdf');

    // Detalle de Compra
    Route::get('/detalle-orden-compra/{id_compra}/agregar', [DetalleOrdenCompraController::class, 'agregarProductos'])->name('detalle-orden-compra.agregar');
    Route::get('/detalle-orden-compra/{id_compra}', [DetalleOrdenCompraController::class, 'index'])->name('detalle-orden-compra.index');
    Route::post('/detalle-orden-compra/guardar', [DetalleOrdenCompraController::class, 'guardarDetallesCompras'])->name('detalle-orden-compra.guardar');

    // Ventas
    Route::resource('/ventas/empleadoventa', VentaController::class)->names('ventas.empleadoventa');
    Route::get('/detalle_ventaempleado/{id_venta}', [DetalleVentaController::class, 'index'])->name('detalle_ventaempleado.index');
    Route::get('/ventas/empleadoventa/pdf/{venta}', [VentaController::class, 'pdf'])->name('ventas.empleadoventa.pdf');
    Route::get('/ventas/empleadoventa/editar/{venta}', [VentaController::class, 'edit'])->name('ventas.empleadoventa.edit');
});
