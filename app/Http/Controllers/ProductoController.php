<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
use App\Models\DetalleCompra;
use App\Models\DetalleVenta;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::latest()->get();

        // Retornamos una vista y enviamos la variable "productos"
        return view('panel.admin.productos.index', compact('productos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //Creamos un Producto nuevo para cargarle datos
        $producto = new Producto();

        //Recuperamos todas las categorias de la BD
        $categorias = Categoria::get(); //Recordar importar el modelo Categoria

        //Retornamos la vista de creacion de productos, enviamos al producto y las categorias
        return view('panel.admin.productos.create', compact('producto', 'categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductoRequest $request)
    {
        $producto = new Producto();

        $producto->id_empleado = auth()->user()->id;
        $producto->id_categoria = $request->get('id_categoria');
        $producto->nombre = $request->get('nombre');
        $producto->descripcion = $request->get('descripcion');
        $producto->stock_disponible = $request->get('stock_disponible');
        $producto->precio = $request->get('precio');

        // Cuando un producto se crea, se pone en estado activo por defecto
        // $producto->activo = $request->get('activo'); 

        if ($request->hasFile('imagen')) {
            // Subida de imagen al servidor (public > storage)
            $image_url = $request->file('imagen')->store('public/productos');
            $producto->url_imagen = asset(str_replace('public', 'storage', $image_url));
        } else {
            $producto->url_imagen = '';
        }

        // Almacena la info del producto en la BD
        $producto->save();

        return redirect()
            ->route('producto.index')
            ->with('alert', 'Producto "' . $producto->nombre . '" agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductoRequest $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        //
    }

    public function obtenerProductosPorCategoria(Request $request)
    {
        $productos_cargados = $request->get('productos_ya_agregados');
        $categoriaId = $request->get('id');

        if ($productos_cargados != null) {
            $productos = Producto::where('id_categoria', $categoriaId)->where('activo', 1)->whereNotIn('id', $productos_cargados)
                ->select('id', 'nombre')
                ->get();
        } else {
            $productos = Producto::where('id_categoria', $categoriaId)->where('activo', 1)
                ->select('id', 'nombre')
                ->get();
        }

        if (!$productos) {
            return response()->json(['message' => 'no se encontro categoria'], 400);
        }

        return response()->json($productos, 200);
    }


    /* public function graficosProductosxCategoria() {
        // Si se hace una peticion AJAX
        if(request()->ajax()) {
            $labels = [];
            $counts = [];

            $categorias = Categoria::get();
            foreach($categorias as $categoria) {
                $labels[] = $categoria->nombre;
                $counts[] = Producto::where('id_categoria', $categoria->id)->count();
            }

            $response = [
                'success' => true,
                'data' => [$labels, $counts]
            ];

            return json_encode($response);
        }

        return view('panel.admin.productos.graficos_productos');
    } */


    public function graficosProductosxCategoria() {
        // Si se hace una petición AJAX
        if(request()->ajax()) {
            $labels = [];
            $counts = [];
    
            // Obtener los detalles de ventas
            $detalles = DetalleVenta::get();
    
            // Crear un array para almacenar la suma de cantidades por producto
            $productosVendidos = [];
    
            // Recorrer los detalles de ventas y acumular las cantidades por producto
            foreach ($detalles as $detalle) {
                if (isset($productosVendidos[$detalle->id_producto])) {
                    // Acumular la cantidad vendida para el producto
                    $productosVendidos[$detalle->id_producto] += $detalle->cantidad;
                } else {
                    // Inicializar la cantidad para un producto
                    $productosVendidos[$detalle->id_producto] = $detalle->cantidad;
                }
            }
    
            // Ordenar los productos por la cantidad vendida (de mayor a menor)
            arsort($productosVendidos);
    
            // Tomar solo los 4 productos más vendidos
            $topProductos = array_slice($productosVendidos, 0, 4, true);
    
            // Recorrer los productos más vendidos y preparar los datos para el gráfico
            foreach ($topProductos as $idProducto => $cantidadVendida) {
                $producto = Producto::find($idProducto); // Obtener el producto por ID
                $labels[] = $producto->nombre; // Obtener el nombre del producto
                $counts[] = $cantidadVendida; // Obtener la cantidad vendida
            }
    
            // Retornar los datos para el gráfico
            $response = [
                'success' => true,
                'data' => [$labels, $counts]
            ];
    
            return json_encode($response);
        }
    
        return view('panel.admin.productos.graficos_productos');
    }

    public function graficosProductosxSolicitudes() {
        // Si se hace una petición AJAX
        if(request()->ajax()) {
            $labels = [];
            $counts = [];
    
            // Obtener los detalles de ventas
            $detalles = DetalleCompra::get();
    
            // Crear un array para almacenar la suma de cantidades por producto
            $productosComprados = [];
    
            // Recorrer los detalles de ventas y acumular las cantidades por producto
            foreach ($detalles as $detalle) {
                if (isset($productosComprados[$detalle->id_producto])) {
                    // Acumular la cantidad vendida para el producto
                    $productosComprados[$detalle->id_producto] += $detalle->cantidad;
                } else {
                    // Inicializar la cantidad para un producto
                    $productosComprados[$detalle->id_producto] = $detalle->cantidad;
                }
            }
    
            // Ordenar los productos por la cantidad vendida (de mayor a menor)
            arsort($productosComprados);
    
            // Tomar solo los 4 productos más vendidos
            $topProductos = array_slice($productosComprados, 0, 4, true);
    
            // Recorrer los productos más vendidos y preparar los datos para el gráfico
            foreach ($topProductos as $idProducto => $cantidadComprada) {
                $producto = Producto::find($idProducto); // Obtener el producto por ID
                $labels[] = $producto->nombre; // Obtener el nombre del producto
                $counts[] = $cantidadComprada; // Obtener la cantidad vendida
            }
    
            // Retornar los datos para el gráfico
            $response = [
                'success' => true,
                'data' => [$labels, $counts]
            ];
    
            return json_encode($response);
        }
    
        return view('panel.admin.productos.graficos_productos2');
    }
    

}