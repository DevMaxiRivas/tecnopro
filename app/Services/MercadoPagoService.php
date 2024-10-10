<?php

namespace App\Services;

use App\Models\Pedido;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Arr;
use MercadoPago\Item;
use MercadoPago\Preference;
use MercadoPago\SDK;

class MercadoPagoService
{

    public function __construct()
    {
        SDK::setAccessToken(config('mercadopago.access_token'));
    }

    public function crearPreferencia($carrito, $id_pedido)
    {

        // Crea un objeto de preferencia
        $preference = new Preference();

        // Creo los items de la preferencia
        $items = [];
        foreach ($carrito as $productoCompra) {

            $item = new Item();
            $item->title = $productoCompra->productos->nombre;
            $item->quantity = $productoCompra->cant_producto;
            $item->unit_price = $productoCompra->subtotal;

            $items[] = $item;
        }

        $preference->back_urls = [
            'success' => route('pedido.pago'),
            'pending' => route('pedido.pago'),
            'failure' => route('pedido.pago')
        ];

        $preference->external_reference = $id_pedido;

        $preference->auto_return = "all";

        $preference->items = $items;

        $preference->payment_methods = [ //Excluye metodos de pago
            'excluded_payment_methods' => array(
                array(
                    'id' => 'rapipago'
                ),
                array(
                    'id' => 'pagofacil'
                )
            )
        ];




        /* $preference->external_reference = $compra->id; */
        $preference->save();

        return $preference;
    }

    public function obtenerPago()
    {
        // Consultar a mercadopago por la preferencia...
    }
}