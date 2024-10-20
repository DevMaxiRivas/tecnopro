<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\OrdenCompra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Proveedor;
use App\Models\FormaPago;

class OrdenesDeCompraController extends Controller
{

    public function index()
    {
        $compras_finalizadas = Compra::where('estado_pedido', Compra::RECIBIDO)->get();
        return view('panel.admin.orden_compras.index', compact('compras_finalizadas'));
    }

    public function show($id)
    {
        $orden_compra = Compra::with('proveedor', 'productos')->findOrFail($id);
        $productos = DetalleCompra::where('id_compra', $orden_compra->id)->get();

        return view('panel.admin.orden_compras.show', compact('orden_compra', 'productos'));
    }

    public function update_precio(Request $request, $id)
    {
    // Encuentra la orden de compra
    $orden_compra = Compra::with('productos')->findOrFail($id);

    // Itera sobre los productos y actualiza los precios
    foreach ($orden_compra->productos as $producto) {
        if (isset($request->precios[$producto->id])) {
            $nuevo_precio = $request->precios[$producto->id];

            // Actualiza el precio en la tabla detalle_compras
            $producto->pivot->precio = $nuevo_precio;
            $producto->pivot->subtotal = $nuevo_precio * $producto->pivot->cantidad; // Recalcula el subtotal
            $producto->pivot->save();
        }
    }
    // Redirige de vuelta con un mensaje de éxito
    return redirect()->route('orden_compras.show', $orden_compra->id)->with('alert', 'Precios actualizados correctamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra)
    {
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();
    
        // Array con los estados y sus descripciones
        $estados = [
            Compra::PENDIENTE => 'Pendiente',
            Compra::ENVIADA => 'Enviado',
            Compra::CONFIRMADA => 'Confirmado',
            Compra::FINALIZADA => 'Finalizado',
            Compra::CANCELADO => 'Cancelado',
        ];
    
        return view('panel.admin.orden_compras.edit', compact('compra', 'proveedores', 'formas_pagos', 'estados'));
    }
    
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        // Validar solo el campo de estado
        $request->validate([
            'estado' => 'required|in:' . implode(',', [
                Compra::PENDIENTE,
                Compra::ENVIADA,
                Compra::CONFIRMADA,
                Compra::FINALIZADA,
                Compra::CANCELADO, 
            ]),
        ]);
    
        // Actualizar solo el estado
        $compra->estado_compra = $request->estado;
        $compra->save();
    
        // Redireccionar con mensaje de éxito
        return redirect()->route('orden_compras.index')
                         ->with('alert', 'Estado de la compra "' . $compra->id . '" actualizado exitosamente.');
    }

    
    public function pdf(Compra $compra)
    {
        $subtotal = 0;
        $detalle_compras = $compra->detalle_compras;
        $proveedor = $compra->proveedores;
        
        foreach ($detalle_compras as $detalle) {
            $subtotal += $detalle->subtotal; 
        }

        $iva = $subtotal * 0.21;
        $total = $subtotal + $iva;
        $fecha_emision = $compra->created_at;
        $fecha_vencimiento = \Carbon\Carbon::parse($fecha_emision)->addDays(30);
        
        $pdf = PDF::loadView('panel.admin.orden_compras.pdf', compact('compra', 'detalle_compras','proveedor','subtotal','total','iva','fecha_vencimiento'));
        
        return $pdf->download('Factura' . $compra->id . '.pdf');
    }

}

    

