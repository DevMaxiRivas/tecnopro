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

    public function create()
    {
        $o_compras = new OrdenCompra();
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();
    
        //Retornamos la vista de creacion de productos, enviamos al compras y proveedores
        return view('panel.admin.orden_compras.create', compact('formas_pagos','proveedores','o_compras')); //compact(mismo nombre de la variable)
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id',  // Verifica que el proveedor exista en la tabla 'proveedores'
            'id_forma_pago' => 'required|exists:forma_pagos,id', // Verifica que la forma de pago exista en la tabla 'formas_pagos'
           // 'total' => 'required|numeric|min:0',  // Asegúrate de que el total sea un número y sea al menos 0
        ]);

        $o_compras = new OrdenCompra();
        $o_compras->id_empleado = auth()->user()->id;
        $o_compras->id_proveedor = $request->get('id_proveedor');
        //dd($request->get('id_forma_pago'));
        $o_compras->id_forma_pago = $request->get('id_forma_pago');
        // Cuando una compra se crea, se pone en estado pendiente por defecto
        // $OrdenCompra->estado=$request->get('pendiente'); 
        // $OrdenCompra->url_factura = $request->get('url_factura');
        $o_compras->total = $request->get('total',0);
        
        // Almacena la info del producto en la BD
        $o_compras->save();

        return redirect()
                ->route('orden_compras.index')
                ->with('alert', 'Compras "' . $o_compras->id . '" Agregado exitosamente ...');
    
    }

    public function show($id)
    {
        $orden_compra = Compra::with('proveedor', 'productos')->findOrFail($id);
        $productos = DetalleCompra::where('id_compra', $orden_compra->id)->get();

        return view('panel.admin.orden_compras.show', compact('orden_compra', 'productos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(OrdenCompra $o_compras )
    {
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();

        // Array con los estados y sus descripciones
        $estados = [
            OrdenCompra::PENDIENTE => 'Pendiente',
            OrdenCompra::EN_ESPERA => 'En espera',
            OrdenCompra::RECIBIDO => 'Recibido',
            OrdenCompra::CANCELADO => 'Cancelado',
        ];

    return view('panel.admin.orden_compras.edit', compact('compra','proveedores','formas_pagos', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,OrdenCompra $o_compras)
    {
    // Validar los campos (incluyendo el estado)
    $request->validate([
        'estado' => 'required|in:' . implode(',', [
            OrdenCompra::PENDIENTE,
            OrdenCompra::EN_ESPERA,
            OrdenCompra::RECIBIDO,
            OrdenCompra::CANCELADO,
        ]),
    ]);
    $o_compras->estado_pedido = $request->get('estado');
    // Guardar los cambios
    $o_compras->update();

    return redirect()
            ->route('orden_compras.index')
            ->with( 'alert', 'Compra "' . $o_compras->id . '" estado actualizado exitosamente.');
    }


}