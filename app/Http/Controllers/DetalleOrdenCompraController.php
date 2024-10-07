<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
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

    public function guardarDetallesCompras(Request $request)
    {
        $orden_compra_id = $request->get('orden_compra_id');
        $orden_compra = Compra::find($orden_compra_id);

        $detalles = $request->get('productos_cargados');
        $productos_por_agregar = $request->get('productos_por_agregar');

        foreach ($detalles as $detalle) {
            $nvo_detalle = DetalleCompra::find((int) $detalle['id_detalle']);
            $nvo_detalle->cantidad = (int) $detalle['cantidad'];
            $nvo_detalle->update();
        }

        foreach ($productos_por_agregar as $producto) {
            $detalle = new DetalleCompra();
            $detalle->id_compra = $orden_compra->id;
            $detalle->id_producto = (int) $producto['id_producto'];
            $detalle->precio = Producto::find((int) $producto['id_producto'])->precio;
            $detalle->subtotal = Producto::find((int) $producto['id_producto'])->precio * (int) $producto['cantidad'];
            $detalle->cantidad = (int) $producto['cantidad'];
            $detalle->save();
        }

        // return redirect()->route('detalle-orden-compra.index', $orden_compra_id);
        return response()->json(['success' => true, 'productos_por_agregar' => $detalle, 'orden_compra_id' => $orden_compra_id, 'detalles' => $detalles]);
    }

    // public function guardarDetallesCompras(Request $request)
    // {
    //     $orden_compra_id = $request->get('orden_compra_id');
    //     $orden_compra = Compra::find($orden_compra_id);

    //     $detalles = $request->get('productos_cargados');
    //     $productos_por_agregar = $request->get('productos_por_agregar');

    //     // Actualizar detalles existentes
    //     foreach ($detalles as $detalleData) {
    //         $detalle = DetalleCompra::find((int) $detalleData['id_detalle']);

    //         // Asegurarse de que el detalle existe antes de actualizar
    //         if ($detalle) {
    //             $detalle->cantidad = (int) $detalleData['cantidad'];
    //             $detalle->save(); // Usa save() en lugar de update()
    //         }
    //     }

    //     // Agregar nuevos productos a la orden de compra
    //     foreach ($productos_por_agregar as $productoData) {
    //         $producto = Producto::find((int) $productoData['id_producto']);

    //         if ($producto) { // Asegurarse de que el producto existe
    //             $detalle = new DetalleCompra();
    //             $detalle->id_compra = $orden_compra->id;
    //             $detalle->id_producto = $producto->id;
    //             $detalle->precio = $producto->precio;
    //             $detalle->cantidad = (int) $productoData['cantidad'];
    //             $detalle->subtotal = $producto->precio * $detalle->cantidad;
    //             $detalle->save();
    //         }
    //     }

    //     return response()->json([
    //         'success' => true,
    //         'productos_por_agregar' => $productos_por_agregar,
    //         'orden_compra_id' => $orden_compra_id,
    //         'detalles' => $detalles
    //     ]);
    // }
}