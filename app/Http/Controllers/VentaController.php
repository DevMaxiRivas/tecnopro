<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class VentaController extends Controller
{
    public function testMercadoPago()
    {
        return view('frontend.test');
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
                ->with('error', 'Pedido N°' . $pedido->id . ' pago cancelado. Vuelve a intentarlo en el panel de mis compras.');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
