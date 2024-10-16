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
            $item->title = $productoCompra->name;
            $item->quantity = $productoCompra->qty;
            $item->unit_price = $productoCompra->price;

            $items[] = $item;
        }

        $preference->back_urls = [
            'success' => route('venta.pago'),
            'pending' => route('venta.pago'),
            'failure' => route('venta.pago')
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

        $preference->save();

        return $preference;
    }
}
