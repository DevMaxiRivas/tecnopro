<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use App\Models\DetalleCompra;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class DetalleCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::where('activo', 1)->get();

        return view('frontend.pages.cart', compact('categorias'));
    }

    public function testProductos()
    {
        $categorias = Categoria::where('activo', 1)->get();
        $productos = Producto::where('activo', true)->get(); //Trae todos los productos "Activos"
        /* $productos = Producto::where('activo', true)
                    ->where('stock_disponible', '>', 0)
                    ->get(); //Trae todos los productos activos y con stock disponible */
        return view('frontend.pages.productosTest', compact('productos', 'categorias'));
    }

    public function contarItemsCarrito()
    {
        $cant_carrito = 0; //Inicio la variable que guarda la cantidad de items en el carrito

        $user_id = Auth::id();
        $carrito = DetalleCompra::latest()->with('productos')->get();

        foreach ($carrito as $item) { //Recorro el carrito y cuento cuantos items hay
            $cant_carrito += $item->cant_producto;
        }

        return $cant_carrito;
    }

    public function agregarAlCarrito(Request $request) //Busca un item especifico en los pedidos y actualiza la cantidad pedida
    {
        $producto = Producto::find($request->_id);

        if (!$producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $user_id = Auth::id();
        $itemViejo = DetalleCompra::where('id_producto', $producto->id)->first(); //Se fija si ya hay un producto igual cargado en el carrito

        if ($itemViejo) { //Si ya existe ese producto en el carrito, solo aumenta la cantidad en +1
            if ($producto->stock_disponible > $itemViejo->cant_producto) {
                $itemViejo->cant_producto += 1;
                $itemViejo->save();
                return response()->json(['message' => 'Uno más agregado al carrito']);
            } else {
                return response()->json(['message' => 'No hay mas stock del producto']);
            }
        } else if ($producto->stock_disponible > 0) { //Si no existe ya en el carrito, verifica que haya stock disponible, y entonces lo agrega
            $nuevoItem = new DetalleCompra();
            $nuevoItem->id_cliente = Auth::id();
            $nuevoItem->id_pedido = null;
            $nuevoItem->id_producto = $producto->id;
            $nuevoItem->cant_producto = 1;
            $nuevoItem->subtotal = $producto->precio * $nuevoItem->cant_producto;

            $nuevoItem->save();

            //Aumento item al carrito

            return response()->json(['message' => 'Producto agregado al carrito correctamente']);
        } else {
            return response()->json(['message' => 'No hay mas stock del producto']);
        }
    }

    public function miCarrito() //Trae todos los productos que esten en un carrito, pero no en un pedido, dependiendo del cliente 
    {
        $user_id = Auth::id();
        $DetalleCompras = DetalleCompra::latest()->with('productos')->get();
        return response()->json($DetalleCompras);
    }

    public function actualizarCantidad(Request $request) //Busca un item especifico en los pedidos y actualiza la cantidad pedida
    {

        $item = DetalleCompra::find($request->_id);

        if (!$item) {
            return response()->json(['error' => 'Item no encontrado'], 404);
        }

        $producto = Producto::find($item->id_producto);

        if ($producto->stock_disponible >= $request->cantidad) {
            $item->cant_producto = $request->cantidad;
            $item->update();
            //Aumento item al carrito

            return response()->json(['message' => 'Cantidad en carrito actualizada correctamente']);
        } else {
            return response()->json(['message' => 'No hay mas stock del producto']);
        }
    }

    public function quitarItem(Request $id) //Elimina una fila de detalle_pedidos, borra un item de un carrito
    {

        $item = DetalleCompra::find($id->_id);

        if (!$item) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        $item->delete();

        return response()->json(['message' => 'Producto eliminado del carrito correctamente']);
    }
}