<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Venta;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;

class DetalleVentaController extends Controller
{
    public function index($venta)
    {
        $venta = Venta::find($venta);
        $productos = DetalleVenta::where('id_venta', $venta->id)->get();

        return view('panel.admin.detalle_ventaempleado.index', compact('productos', 'venta'));
    }}