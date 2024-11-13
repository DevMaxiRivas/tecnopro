<?php

namespace App\Http\Controllers;

use App\Exports\OrdenCompraExport;
use App\Imports\OrdenCompraImport;
use App\Models\Categoria;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

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

    public function guardarDetallesCompras(Request $request)
    {
        $orden_compra_id = $request->get('orden_compra_id');
        $orden_compra = Compra::find($orden_compra_id);

        $detalles = $request->get('productos_cargados');
        $productos_por_agregar = $request->get('productos_por_agregar');

        foreach ($detalles as $detalle) {
            $nvo_detalle = DetalleCompra::find((int) $detalle['id_detalle']);
            $nvo_detalle->cantidad = (int) $detalle['cantidad'];
            // $nvo_detalle->precio = 0;
            // $nvo_detalle->subtotal = 0;
            $nvo_detalle->update();
        }

        foreach ($productos_por_agregar as $producto) {
            $detalle = new DetalleCompra();
            $detalle->id_compra = $orden_compra->id;
            $detalle->id_producto = (int) $producto['id_producto'];
            $detalle->cantidad = (int) $producto['cantidad'];
            // $detalle->precio = 0;
            // $detalle->subtotal = 0;
            $detalle->save();
        }

        return response()->json(['success' => true, 'productos_por_agregar' => $detalle, 'orden_compra_id' => $orden_compra_id, 'detalles' => $detalles]);
    }

    public function exportarDetalleCompraExcel($orden_compra) {
        return Excel::download(new OrdenCompraExport($orden_compra), 'orden_compra_'.$orden_compra.'.xlsx');     
    }

    public function importarDetalleCompraExcel(Request $request) {

        // Validar que el archivo exista y sea un archivo Excel
        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
        ]);

        // Procesar el archivo y cargar los datos
        Excel::import(new OrdenCompraImport, $request->file('file'));

        return back()->with('success', 'Importación realizada correctamente.');
    }
}