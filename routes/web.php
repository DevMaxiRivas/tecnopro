<?php

// Rutas del Home

use App\Http\Controllers\DetalleCompraController;
use App\Http\Controllers\PaginaDeInicio;
use App\Http\Controllers\ProductoController;
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
    Route::get('/carrito', [DetalleCompraController::class, 'index'])->name('carrito.carrito');
    Route::get('/miCarrito', [DetalleCompraController::class, 'miCarrito'])->name('carrito.miCarrito');
    Route::get('/agregarProductos', [DetalleCompraController::class, 'testProductos'])->name('carrito.agregarProductos');
    Route::post('/miCarrito/quitarItem', [DetalleCompraController::class, 'quitarItem'])->name('carrito.quitarItem');
    Route::post('/miCarrito/actualizarCantidad', [DetalleCompraController::class, 'actualizarCantidad'])->name('carrito.actualizarCantidad');
    Route::post('/miCarrito/agregarAlCarrito', [DetalleCompraController::class, 'agregarAlCarrito'])->name('carrito.agregarAlCarrito');

    // Rutas para generar y pagar el pedido
    Route::get('/carritoCantidadItems', [DetalleCompraController::class, 'contarItemsCarrito'])->name('carrito.contarItemsCarrito');
    // Route::post('/carrito/checkout', [App\Http\Controllers\PedidoController::class, 'checkout'])->name('carrito.checkout');
    //Route::get('/carrito/checkout', [App\Http\Controllers\PedidoController::class, 'create'])->name('carrito.create');
    //Route::any('/carrito/guardar', [App\Http\Controllers\PedidoController::class, 'store'])->name('pedido.store');
    //Route::any('/pedido/pago', [App\Http\Controllers\PedidoController::class, 'pago'])->name('pedido.pago');

    // Test Mercado Pago
    Route::get('/test-mercado-pago', [App\Http\Controllers\VentaController::class, 'comprar'])->name('test-mercado-pago');
    Route::post('/comprar', [App\Http\Controllers\VentaController::class, 'comprar'])->name('carrito.comprar');
    Route::any('/venta/pago', [App\Http\Controllers\VentaController::class, 'pago'])->name('venta.pago');
});