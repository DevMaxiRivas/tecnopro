<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Proveedor;
use App\Models\FormaPago;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::latest()->get();
        return view('panel.admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        //$compras = new Compra();
        $compra = new Compra();
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();
       

        //Retornamos la vista de creacion de productos, enviamos al compras y proveedores
        return view('panel.admin.compras.create', compact('formas_pagos','proveedores','compra')); //compact(mismo nombre de la variable)
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id',  // Verifica que el proveedor exista en la tabla 'proveedores'
            'id_forma_pago' => 'required|exists:forma_pagos,id', // Verifica que la forma de pago exista en la tabla 'formas_pagos'
           // 'total' => 'required|numeric|min:0',  // Asegúrate de que el total sea un número y sea al menos 0
        ]);

        $compra = new Compra();
        $compra->id_empleado = auth()->user()->id;
        $compra->id_proveedor = $request->get('id_proveedor');
        //dd($request->get('id_forma_pago'));
        $compra->id_forma_pago = $request->get('id_forma_pago');
        // Cuando una compra se crea, se pone en estado pendiente por defecto
        #$compras->estado=$request->get('pendiente'); 
        //$compras->url_factura = $request->get('url_factura');
        $compra->total = $request->get('total',0);
        

        // Almacena la info del producto en la BD
        $compra->save();

        return redirect()
                ->route('compras.index')
                ->with('alert', 'Compras "' . $compra->id . '" Agregado exitosamente ...');
    
    }

    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra )
    {
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();
    // Array con los estados y sus descripciones
    $estados = [
        Compra::PENDIENTE => 'Pendiente',
        Compra::EN_ESPERA => 'En espera',
        Compra::RECIBIDO => 'Recibido',
        Compra::CANCELADO => 'Cancelado',
    ];

    return view('panel.admin.compras.edit', compact('compra','proveedores','formas_pagos', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Compra $compra)
    {
    // Validar los campos (incluyendo el estado)
    $request->validate([
        'estado' => 'required|in:' . implode(',', [
            Compra::PENDIENTE,
            Compra::EN_ESPERA,
            Compra::RECIBIDO,
            Compra::CANCELADO,
        ]),
    ]);
    $compra->estado = $request->get('estado');
    // Guardar los cambios
    $compra->update();

    return redirect()
            ->route('compras.index')
            ->with( 'alert', 'Compra "' . $compra->id . '" estado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
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
    $pdf = PDF::loadView('panel.admin.pdf', compact('compra', 'detalle_compras','proveedor','subtotal','total','iva','fecha_vencimiento'));
    return $pdf->download('Reporte_de_Compra_' . $compra->id . '.pdf');

    
}

}

