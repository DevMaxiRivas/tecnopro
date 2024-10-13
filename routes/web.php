<?php

// Rutas del Home

use App\Http\Controllers\CarritoController;
use App\Http\Controllers\PaginaDeInicio;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\VentaController;
use App\Models\Venta;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Productos
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/', [PaginaDeInicio::class, 'MandarDatosPaginaInicio'])->name('MandarDatosPaginaInicio');
Route::get('productos', [PaginaDeInicio::class, 'MandarDatosLista'])->name('productos');
Route::get('productos/categoria/{categoria}', [PaginaDeInicio::class, 'MandarDatosCategoriaEspecifica'])->name('MandarDatosCategoriaEspecifica');
Route::get('productos/detallesProducto/{producto}', [PaginaDeInicio::class, 'MandarDatosProductoEspecifico'])->name('MandarDatosProductoEspecifico');
Route::get('productos/filtroPrecio', [PaginaDeInicio::class, 'filtrarPorPrecio'])->name('filtrarPorPrecio');
Route::get('/resultados', [PaginaDeInicio::class, 'resultadosBusqueda'])->name('resultados-busqueda');
// API Productos
Route::get('productos/categoria', [ProductoController::class, 'obtenerProductosPorCategoria'])->name('obtener-productos-por-categoria');


Route::middleware('auth')->group(function () {

    // Carrito de compras
    // Route::get('/carrito', [App\Http\Controllers\DetalleComprasController::class, 'index'])->name('carrito.carrito');
    // Route::get('/miCarrito', [App\Http\Controllers\DetalleComprasController::class, 'miCarrito'])->name('carrito.miCarrito');
    // Route::get('/agregarProductos', [App\Http\Controllers\DetalleComprasController::class, 'testProductos'])->name('carrito.agregarProductos');
    // Route::post('/miCarrito/quitarItem', [App\Http\Controllers\DetalleComprasController::class, 'quitarItem'])->name('carrito.quitarItem');
    // Route::post('/miCarrito/actualizarCantidad', [App\Http\Controllers\DetalleComprasController::class, 'actualizarCantidad'])->name('carrito.actualizarCantidad');
    // Route::post('/miCarrito/agregarAlCarrito', [App\Http\Controllers\DetalleComprasController::class, 'agregarAlCarrito'])->name('carrito.agregarAlCarrito');
    // Route::get('/carritoCantidadItems', [App\Http\Controllers\DetalleComprasController::class, 'contarItemsCarrito'])->name('carrito.contarItemsCarrito');

    Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.carrito');
    Route::get('/miCarrito', [CarritoController::class, 'miCarrito'])->name('carrito.miCarrito');
    Route::post('/miCarrito/quitarItem', [CarritoController::class, 'quitarItem'])->name('carrito.quitarItem');
    Route::post('/miCarrito/actualizarCantidad', [CarritoController::class, 'actualizarCantidad'])->name('carrito.actualizarCantidad');
    Route::post('/miCarrito/agregarAlCarrito', [CarritoController::class, 'store'])->name('carrito.agregarAlCarrito');
    Route::get('/carritoCantidadItems', [CarritoController::class, 'contarItemsCarrito'])->name('carrito.contarItemsCarrito');
    Route::post('/carrito/guardar', [CarritoController::class, 'crearVenta'])->name('carrito.crearVenta');
    Route::get('/carrito/checkout', [CarritoController::class, 'create'])->name('carrito.checkout');

    // Rutas para generar y pagar el pedido
    // Route::post('/carrito/checkout', [App\Http\Controllers\PedidoController::class, 'checkout'])->name('carrito.checkout');
    // Route::get('/carrito/checkout', [App\Http\Controllers\PedidoController::class, 'create'])->name('carrito.create');
    // Route::any('/carrito/guardar', [App\Http\Controllers\PedidoController::class, 'store'])->name('pedido.store');
    // Route::any('/pedido/pago', [App\Http\Controllers\PedidoController::class, 'pago'])->name('pedido.pago');
});
