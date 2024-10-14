<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleVentaClienteController extends Controller
{
    public function index($ventas_id)
    {
        $venta = Venta::findOrFail($ventas_id);
        $productos = DetalleVenta::where('id_venta', $ventas_id)->get();

        return view('panel.admin.detalle_ventas.index', compact('productos', 'venta'));
    }

}
