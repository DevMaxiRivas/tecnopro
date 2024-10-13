<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\User;
class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ventas = Venta::latest()->get();
        return view('panel.admin.ventas.index', compact('ventas'));
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
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {
       
        // Array con los estados y sus descripciones
        $estados = [
            Venta::PENDIENTE => 'Pendiente',
            Venta::PAGADO => 'Pagado',
            Venta::EN_PREPARACION => 'En preparación',
            Venta::ENVIADO => 'Enviado',
            Venta::CANCELADO => 'Cancelado',
        ];

    return view('panel.admin.ventas.edit', compact('venta','estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
        {
            // Validar los campos (incluyendo el estado)
            $request->validate([
                'estado' => 'required|in:' . implode(',', [
                    Venta::PENDIENTE,
                    Venta::PAGADO,
                    Venta::EN_PREPARACION,
                    Venta::ENVIADO,
                    Venta::CANCELADO
                ]),
            ]);
            
            if ($venta->estado === Venta::PAGADO && $request->get('estado') === Venta::EN_PREPARACION) {
                $venta->id_empleado = auth()->user()->id;; // Asigna el ID del empleado
            }
            $venta->estado = $request->get('estado');
            $venta->update();
            return redirect()
                    ->route('ventas.index')
                    ->with( 'alert', 'Venta "' . $venta->id . '" estado actualizado exitosamente.');
            }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
    public function pdf(Venta $venta)
    {
        $total = 0;
        $detalle_ventas = $venta->detalle_ventas;
        $cliente = $venta->cliente;
        
        foreach ($detalle_ventas as $detalle) {
            $total += $detalle->subtotal; 
        }

        /* $iva = $subtotal * 0.21;
        $total = $subtotal + $iva; */
        $fecha_emision = $venta->created_at;
        $fecha_vencimiento = \Carbon\Carbon::parse($fecha_emision)->addDays(30);
        
        $pdf = PDF::loadView('panel.admin.ventas.pdf', compact('venta', 'detalle_ventas','cliente','total','fecha_vencimiento'));
        
        return $pdf->download('Reporte_de_Venta_' . $venta->id . '.pdf');
    }

}
