<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::latest()->get();
        return view('panel.admin.ventas.empleadoventa.index', compact('ventas'));
    }

    public function pago(Request $request) //Registra el pago de un pedido
    {
        //Funcion para consultar si un pedido ya fue pagado
        $payment_id = $request->payment_id; //Id del pago, se ve en el comprobante
        $token = config('mercadopago.access_token');
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=$token");
        $response = json_decode($response);
        $pedido_id = $request->external_reference; //Trae el ID del pedido, que mandamos por external_reference al crear la preferencia de mercado pago
        $pedido = Venta::find($pedido_id); //busco el pedido

        //Si no se realiza el pago y se vuelve al sitio
        if (!isset($response->error)) {
            $status = $response->status;
        } else {

            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('error', 'Pedido N°' . $pedido->num_pedido . ' pago cancelado. Vuelve a intentarlo en el panel de mis compras.');
        }

        //Si se vuelve al sitio luego de pagar el pedido con mercado pago
        if ($status == "approved") {
            $pedido->estado = Venta::PAGADO; //Cambia estado del pedido
            $pedido->save(); //Guarda el pedido exitosamente
            Producto::actualizarStocks($pedido->id);

            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('alert', 'Pedido N°' . $pedido->id . ' pagado exitosamente. Con N° de operación: ' . $response->id);
        } else {
            //Si no se pudo pagar, no cambia el estado del pedido a pagado
            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('error', 'Pedido N°' . $pedido->id . ' no se pudo completar el pago. Con N° operación: ' . $response->id);
        }
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

        return view('panel.admin.ventas.empleadoventa.edit', compact('venta', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
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
            $venta->id_empleado = auth()->user()->id; // Asigna el ID del empleado
        }

        // Actualiza el estado y otros campos necesarios
        $venta->estado = $request->get('estado');
        $venta->update(); // Guarda los cambios

        return redirect()
            ->route('ventas.empleadoventa.index')
            ->with('alert', 'Venta "' . $venta->id . '" estado actualizado exitosamente.');
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
        $detalle_ventas = $venta->detalle_ventas;
        $cliente = $venta->cliente;
        $total = $venta->total;
        $fecha_emision = $venta->created_at;
        $fecha_vencimiento = \Carbon\Carbon::parse($fecha_emision)->addDays(30);
        $pdf = PDF::loadView('panel.admin.ventas.pdf', compact('venta', 'detalle_ventas', 'cliente', 'total', 'fecha_vencimiento'));
        return $pdf->download('Reporte_de_Venta_' . $venta->id . '.pdf');
    }
}
