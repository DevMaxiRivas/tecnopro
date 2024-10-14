<?php

namespace App;

use App\Models\Producto;
use Gloudemans\Shoppingcart\Facades\Cart;

class Helper {

    // Recupera el producto del carrito
    public static function getProductCart($id_product) 
    {
        $cart = Cart::content();

        $item = $cart->where('id', $id_product)->first();

        return $item ? $item : null;
    }

    // Actualiza el stock despues de una compra, restando
    public static function discountStock($idProducto, $quantity)
    {
        $producto = Producto::find($idProducto);

        // Si el producto no existe
        if(! $producto) return false;
        
        // No hay stock suficiente
        if($producto->stock_disponible < $quantity) return false;

        // Actualizamos el stock
        $producto->stock_disponible -= $quantity;
        $producto->save();

        return true;
    }

}