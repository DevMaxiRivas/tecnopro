<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\DetalleCompra;
use Illuminate\Http\Request;

class DetalleOrdenCompraController extends Controller
{
    public function index($orden_compra)
    {
        $orden_compra = Compra::find($orden_compra);
        $productos = DetalleCompra::where('id_compra', $orden_compra->id)->get();

        return view('panel.admin.detalle_compra.index', compact('productos', 'orden_compra'));
    }

    public function agregarProductos($orden_compra)
    {
        $orden_compra = Compra::find($orden_compra);
        $categorias = Categoria::obtenerCategorias();
        $detalles = DetalleCompra::where('id_compra', $orden_compra->id)->get();
        return view('panel.admin.detalle_compra.create', compact('orden_compra', 'detalles', 'categorias'));
    }
}
