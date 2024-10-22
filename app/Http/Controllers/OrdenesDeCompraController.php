<?php

namespace App\Http\Controllers;

use App\Jobs\EnviarOrdenCompraJob;
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
        $compras_finalizadas = Compra::whereNotNull('estado_compra')->get();
        return view('panel.admin.orden_compras.index', compact('compras_finalizadas'));
    }

    public function show($orden_compra)
    {
        $orden_compras = Compra::with('proveedor', 'productos')->findOrFail($orden_compra);
        $productos = DetalleCompra::where('id_compra', $orden_compras->id)->get();
        return view('panel.admin.orden_compras.show', compact('orden_compras', 'productos'));
    }
     
    public function create()
    {
        $orden_compra = new Compra();
        //$proveedores = Compra::where('estado_pedido',Compra::RECIBIDO)->distinct()->whereNull('estado_compra')->with('proveedor')->get();
        //$proveedores = Proveedor::with('compras')->where('compras.estado_pedido',Compra::RECIBIDO)->distinct()->get();
        $proveedores = Proveedor::whereHas('compras', function ($query) {$query->where('estado_pedido', Compra::RECIBIDO);})->distinct()->get();
        $formas_pagos = FormaPago::get();
        
        return view('panel.admin.orden_compras.create', compact('formas_pagos', 'proveedores', 'orden_compra'));
    }

    public function getSolicitudesPorProveedor($id)
    {
        $solicitudes = Compra::where('id_proveedor', $id)->whereNull('estado_compra')->where('estado_pedido',Compra::RECIBIDO)->get();

        return response()->json(['solicitudes' => $solicitudes]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id',  // Verifica que el proveedor exista en la tabla 'proveedores'
            // 'id_forma_pago' => 'required|exists:forma_pagos,id', // Verifica que la forma de pago exista en la tabla 'formas_pagos'
            'id_compra' => 'required|exists:compras,id'
            // 'total' => 'required|numeric|min:0',  // Asegúrate de que el total sea un número y sea al menos 0
        ]);

        $compra = Compra::where('id',$request->id_compra)->first();
        $compra->id_empleado_compra = auth()->user()->id;
        $compra->estado_compra = Compra::PENDIENTE;
 
        // Almacena la info del producto en la BD
        $compra->save();

        return redirect()
                ->route('orden_compras.index')
                ->with('alert', 'Compras "' . $compra->id . '" Agregado exitosamente ...');
    
    }

    public function update_precio(Request $request, $id)
    {
        $orden_compra = Compra::with('productos')->findOrFail($id);
        $total = 0;

        // Itera sobre los productos y actualiza los precios
        foreach ($orden_compra->productos as $producto) {

            $detalleCompra = $producto->pivot;

            // Si el producto en el detalle de compra esta inactivo
            if($detalleCompra->estado == DetalleCompra::INACTIVO) continue;

            // Si no existe el producto en el detalle de la orden de compra
            if (! isset($request->precios[$detalleCompra->id_producto])) continue;

            $nuevo_precio = $request->precios[$detalleCompra->id_producto];

            // Falta validar que el precio sea valido (no vacio y mayor a 0)
            if(! $nuevo_precio || $nuevo_precio <= 0) continue;

            // Actualiza el precio en la tabla detalle_compras
            $detalleCompra->precio = $nuevo_precio;
            $detalleCompra->subtotal = $nuevo_precio * $detalleCompra->cantidad; // Recalcula el subtotal
            $detalleCompra->save();

            // Total para actualizar a la Compra
            $total += $producto->pivot->subtotal;
        }

        $orden_compra->total = $total;
        $orden_compra->save();

        // Redirige de vuelta con un mensaje de éxito
        return redirect()->route('orden_compras.show', $orden_compra->id)->with('alert', 'Precios actualizados correctamente.');
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $orden_compra)
    {
        //return $orden_compra;
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
    
        return view('panel.admin.orden_compras.edit', compact('orden_compra', 'proveedores', 'formas_pagos', 'estados'));
    }
    
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $orden_compra)
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
        $orden_compra->estado_compra = $request->estado;
        $orden_compra->save();

        // Generar el PDF
        if($orden_compra->estado_compra == Compra::ENVIADA 
            && is_null($orden_compra->url_factura)) {
            $this->generar_pdf($orden_compra);
        }

        // Enviar correo
        if($orden_compra->estado_email_enviado_compra == Compra::FACTURA_NO_ENVIADA) {
            EnviarOrdenCompraJob::dispatch($orden_compra->id)->onConnection('database');
        }
    
        // Redireccionar con mensaje de éxito
        return redirect()->route('orden_compras.index')
                         ->with('alert', 'Estado de la compra "' . $orden_compra->id . '" actualizado exitosamente.');
    }

    public function generar_pdf(Compra $compra)
    {
        $subtotal = 0;
        
        // $detalle_compras = $compra->detalle_compras;
        $detalle_compras = DetalleCompra::where('id_compra', $compra->id)
                                    ->where('estado', DetalleCompra::ACTIVO)
                                    ->get();
                                
        $proveedor = $compra->proveedores;
        
        foreach ($detalle_compras as $detalle) {
            $subtotal += $detalle->subtotal; 
        }

        $iva = $subtotal * 0.21;
        // $total = $subtotal + $iva;
        $total = $subtotal;
        $fecha_emision = $compra->created_at;
        $fecha_vencimiento = \Carbon\Carbon::parse($fecha_emision)->addDays(30);
        
        $pdf = PDF::loadView('panel.admin.orden_compras.pdf', compact('compra', 'detalle_compras','proveedor','subtotal','total','iva','fecha_vencimiento'));

        $filename = 'orden_compra_' . $compra->id . '.pdf';
    
        // Guarda el archivo en la carpeta deseada
        $pdf->save(storage_path('app/public/facturas/' . $filename)); // Asegúrate de que esta carpeta exista
    
        // Guarda la URL en el modelo de Compra
        $compra->url_factura = 'storage/facturas/' . $filename; // Guarda la URL
        $compra->save(); // No olvides guardar los cambios en la base de datos
    
        // Retorna el PDF para descargar
        // return $pdf->download($filename);
    }

    public function update_estado(Request $request) {

        $detalleCompra = DetalleCompra::where('id_compra', $request->id_compra)
                                    ->where('id_producto', $request->id_producto)
                                    ->first();
        
        // Si no existe el producto
        if(! $detalleCompra) {
            return response()->json([
                'success' => false,
                'message' => 'Producto no encontrado'
            ]);
        }

        // El estado debe existir
        if(! in_array($request->estado, [DetalleCompra::ACTIVO, DetalleCompra::INACTIVO])) {
            return response()->json([
                'success' => false,
                'message' => 'Estado no encontrado'
            ]);
        }
        
        // Actualizacion del estado
        $detalleCompra->estado = $request->estado;
        $detalleCompra->save();

        return response()->json([
            'success' => true,
            'message' => 'Estado actualizado con éxito'
        ]);
    }

}

    

