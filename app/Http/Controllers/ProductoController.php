<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductoRequest;
use App\Models\Categoria;
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
        $categoriaId = $request->get('id');
        $productos = Producto::where('id_categoria', $categoriaId)->where('activo', 1)
            ->select('id', 'nombre')
            ->get();

        if (!$productos) {
            return response()->json(['message' => 'categoria not found'], 404);
        }

        return response()->json($productos, 200);
    }
}
