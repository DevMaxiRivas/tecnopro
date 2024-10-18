<?php

namespace App\Http\Controllers;

use App\Helper;
use App\Models\Categoria;
use App\Models\EnvioVenta;
use App\Models\FormaPago;
use App\Models\Producto;
use App\Models\Venta;
use App\Services\MercadoPagoService;
use Exception;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\error;

class CarritoController extends Controller
{

    public function __construct( //Incluye el servicio de MercadoPago
        private MercadoPagoService $mercadoPagoService
    ) {}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::where('activo', 1)->get();

        return view('frontend.pages.cart', compact('categorias'));
    }

    // Trae todos los productos que esten en un carrito
    public function miCarrito()
    {
        foreach (Cart::content() as $item) {

            // Producto de la BD
            $producto = Producto::find($item->id);

            // Si no encuentro el producto, paso a la siguente iteracion
            if (! $producto) continue;

            $data[] = [
                'id' => $item->id,
                'nombre' => $item->name,
                'url_imagen' => $item->options->url_imagen,
                'subtotal' => $item->subtotal,
                'stock_disponible' => $producto->stock_disponible,
                'cant_producto' => $item->qty
            ];
        }

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $carrito = Cart::content();

        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();

        $cliente = auth()->user();

        $formas_pagos = FormaPago::where('activo', FormaPago::ACTIVO)->get();

        return view('frontend.pages.checkout', compact('cliente', 'carrito', 'categorias', 'formas_pagos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Buscamos el producto en la BD
        $producto = Producto::where('id', $request->_id)->first();

        if (! $producto) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Buscamos el producto del carrito
        $productoCarrito = Helper::getProductCart($producto->id);

        // Si el producto existe
        if ($productoCarrito) {

            // Verificamos que haya stock disponible
            if ($producto->stock_disponible > $productoCarrito->qty) {
                Cart::add([
                    'id' => $producto->id,
                    'name' => $producto->nombre,
                    'qty' => 1,
                    'price' => $producto->precio,
                    'weight' => 0,
                    'options' => [
                        'url_imagen' => $producto->url_imagen
                    ]
                ]);

                return response()->json([
                    'message' => 'Producto agregado al carrito correctamente'
                ]);
            } else {
                return response()->json([
                    'message' => 'No hay mas stock del producto'
                ]);
            }
        } else {

            // Producto nuevo para agregar al carrito
            Cart::add([
                'id' => $producto->id,
                'name' => $producto->nombre,
                'qty' => 1,
                'price' => $producto->precio,
                'weight' => 0,
                'options' => [
                    'url_imagen' => $producto->url_imagen
                ]
            ]);

            return response()->json([
                'message' => 'Producto agregado al carrito correctamente'
            ]);
        }
    }

    public function contarItemsCarrito()
    {
        return Cart::count();
    }

    // Elimina un producto del Objeto Cart
    public function quitarItem(Request $request)
    {
        // Buscamos el producto del carrito
        $productoCarrito = Helper::getProductCart($request->_id);

        // Si no existe el producto en el carrito
        if (! $productoCarrito) {
            return response()->json(['error' => 'Producto no encontrado'], 404);
        }

        // Eliminamos el producto del carrito
        Cart::remove($productoCarrito->rowId);

        return response()->json(['message' => 'Producto eliminado del carrito correctamente']);
    }

    // Busca un item especifico en los pedidos y actualiza la cantidad pedida
    public function actualizarCantidad(Request $request)
    {
        // Buscamos el producto del carrito
        $productoCarrito = Helper::getProductCart($request->_id);

        // Si no existe el producto en el carrito
        if (! $productoCarrito) {
            return response()->json(['error' => 'Item no encontrado'], 404);
        }

        // Producto de la BD
        $producto = Producto::find($productoCarrito->id);

        // Si no existe el producto en la BD
        if (! $producto) {
            return response()->json(['error' => 'Item no encontrado'], 404);
        }

        // Verificamos stock
        if ($producto->stock_disponible > $request->cantidad) {

            // Si hay stock, actualizamos en el carrito
            Cart::update($productoCarrito->rowId, $request->cantidad);

            return response()->json(['message' => 'Cantidad actualizada correctamente']);
        } else {
            return response()->json(['message' => 'No hay mas stock del producto']);
        }
    }

    public function crearVenta(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:5|regex:/^[\p{L} ]+$/u',
            'dni' => 'required|integer|min:7',
            'email' => 'required|string|max:255|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'telefono' => 'required|integer|min:10',
            'direccion' => 'required|string',
            'codigo_postal' => 'required|integer|min:4',
            'id_forma_pago' => 'required|integer|exists:forma_pagos,id,activo,' . FormaPago::ACTIVO
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.regex' => 'El campo nombre debe tener solo letras',

            'dni.required' => 'El campo dni es obligatorio.',
            'dni.integer' => 'El campo dni debe ser un numero',
            'dni.min' => 'El campo dni debe tener como minimo 7 caracteres',

            'email.required' => 'El campo email es obligatorio.',
            'email.regex' => 'El campo email tiene un formato incorrecto',

            'telefono.required' => 'El campo telefono es obligatorio',
            'telefono.integer' => 'El campo telefono debe ser un numero',
            'telefono.min' => 'El campo telefono debe tener como minimo 10 caracteres',

            'direccion.required' => 'El campo direccion es obligatorio',

            'codigo_postal.required' => 'El campo codigo postal es obligatorio',
            'codigo_postal.integer' => 'El campo codigo postal debe ser un numero',
            'codigo_posta.min' => 'El campo codigo postal debe tener como minimo 4 numeros',

            'id_forma_pago.required' => 'El campo forma de pago es obligatorio',
            'id_forma_pago.integer' => 'El campo forma de pago es erronea',
            'id_forma_pago.exists' => 'El campo forma de pago es erronea.'
        ]);

        DB::beginTransaction();

        try {
            $venta = new Venta();

            $cliente = auth()->user();

            $venta->id_forma_pago = $request->id_forma_pago;
            $venta->id_cliente = $cliente->id;
            $venta->total = floatval(str_replace(',', '', Cart::subtotal()));
            $venta->estado_factura = Venta::FACTURA_NO_ENVIADA;

            $venta->save();
            
            $carrito = Cart::content();

            // Genero preferencia de mercado pago
            $preferencia = $this->mercadoPagoService->crearPreferencia($carrito, $venta->id); //Creo link de pago

            // Asigno link de pago
            $venta->link_pago = $preferencia->init_point;
            $venta->save();

            // Se guardan los detalles de venta
            foreach ($carrito as $item) {
                $venta->detalle_ventas()->create([
                    'id_venta' => $venta->id,
                    'id_producto' => $item->id,
                    'precio' => $item->price,
                    'cantidad' => $item->qty,
                    'subtotal' => $item->qty * $item->price
                ]);

                // Actualizamos Stock
                // $flag = Helper::discountStock($item->id, $item->qty);

                // // Si no se pudo actualizar el stock
                // if (! $flag) {
                //     throw new Exception('Error de actualización de Stock');
                // }
            }

            // Cargamos los datos de envio para la venta del formulario
            $envioVenta = new EnvioVenta();
            $envioVenta->id_venta = $venta->id;
            $envioVenta->name = $request->nombre;
            $envioVenta->dni = $request->dni;
            $envioVenta->email = $request->email;
            $envioVenta->telefono = $request->telefono;
            $envioVenta->domicilio = $request->direccion;
            $envioVenta->codigo_postal = $request->codigo_postal;
            // $envioVenta->latitud = $request->latitud;
            // $envioVenta->longitud = $request->longitud;
            
            $envioVenta->save();
            
            // Guardamos la geoposicion del cliente
            // if(! $cliente->latitud && ! $cliente->longitud) {
            //     $cliente->latitud = $request->latitud;
            //     $cliente->longitud = $request->longitud;
            //     $cliente->save();
            // }

            // Guardamos el telefono del cliente
            // if(! $cliente->telefono) {
            //     $cliente->telefono = $request->telefono;
            //     $cliente->save();
            // }

            // Confirmar la transacción
            DB::commit();

            // Se destruye el carrito
            Cart::destroy();

            // TODO: Falta enviar mail de confirmacion de venta, adjuntado la factura

            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('alert', 'Pedido de ' . $venta->cliente->name . ' agregado exitosamente. Con N°' . $venta->id . '. Abriendo link de pago...')
                ->with('redirectUrl', $preferencia->init_point);
        } catch (Exception $e) {
            DB::rollback(); // Revertir cambios si hay un error

            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('alert', 'Ocurrio un error al confirmar su compra.' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
