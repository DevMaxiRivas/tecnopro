<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Services\MercadoPagoService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class VentaController extends Controller
{
    public function __construct( //Incluye el servicio de MercadoPago
        private MercadoPagoService $mercadoPagoService
    ) {}

    public function testMercadoPago()
    {
        return view('frontend.test');
    }

    public function comprar(Request $request)
    {

        // $id_venta = $request->get('id_venta');
        $id_venta = 1;
        $venta = Venta::find($id_venta);

        $carrito = DetalleVenta::latest()->where('id_venta', $id_venta)->get();
        foreach ($carrito as $item) {
            $venta->total += $item->subtotal;
        }
        //Si el carrito esta vacio, entonces no se genera el pedido
        if (!$venta->total) {
            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('alert', 'No se puede guardar un pedido vacio. ' . '¡Agrega algunos productos al carrito por favor!');
        }

        // Genero preferencia de mercado pago
        $preferencia = $this->mercadoPagoService->crearPreferencia($carrito, $venta->id); //Creo link de pago

        // Asigno link de pago
        $venta->link_pago = $preferencia->init_point;

        // Asigno estado
        $venta->estado = Venta::PENDIENTE;

        $venta->save();

        // Redirigiendo al home, para luego cargar checkoutPRO
        return redirect()
            ->route('MandarDatosPaginaInicio')
            ->with('alert', 'Pedido de ' . $venta->cliente->name . ' agregado exitosamente. Con N°' . $venta->id . '. Abriendo link de pago...')
            ->with('redirectUrl', $preferencia->init_point);
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
}