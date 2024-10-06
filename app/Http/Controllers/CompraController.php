<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit(Compra $compra)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Compra $compra)
    {
        //
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

