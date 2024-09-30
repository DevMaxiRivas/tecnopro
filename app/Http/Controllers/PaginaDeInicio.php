<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class PaginaDeInicio extends Controller
{
    public function MandarDatosPaginaInicio()
    {
        $productos = Producto::latest()->get();

        $categorias = Categoria::get();

        $carrusel = Producto::inRandomOrder()->take(3)->get();

        return view('frontend.index', compact('productos', 'categorias', 'carrusel'));
    }

    public function resultadosBusqueda(Request $request)
    {

        $categorias = Categoria::get();

        $terminoBusqueda = $request->input('busqueda');
        $productosResultados = Producto::where('nombre', 'like', '%' . $terminoBusqueda . '%')->simplePaginate(12)->withQueryString();

        return view('frontend.paginas.resultados_busqueda', compact('categorias', 'productosResultados', 'terminoBusqueda'));
    }

    public function MandarDatosLista()
    {
        $categorias = Categoria::get();


        $productos = Producto::latest()
            ->simplePaginate(24)
            ->withQueryString();

        return view('frontend.paginas.productosLista', compact('productos', 'categorias'));
    }

    public function MandarDatosCategoriaEspecifica($variable)
    {
        $productos = Producto::latest()->take(2)->get();
        $categorias = Categoria::get();

        $categoria = Categoria::where('id', $variable)->first();
        $categoriaEspecifica = $categoria->nombre;


        $productos_especificos = Producto::where('id_categoria', $variable)
            ->latest()
            ->simplePaginate(12)
            ->withQueryString();

        return view('frontend.paginas.productosListaEspecifica', compact('productos_especificos', 'categorias', 'categoriaEspecifica'));
    }

    public function MandarDatosProductoEspecifico($id)
    {
        $producto = Producto::find($id);
        $categorias = Categoria::get();

        $categoriaEspecifica = Categoria::find($producto->id_categoria);

        return view('frontend.paginas.productoDetalle', compact('producto', 'categorias', 'categoriaEspecifica'));
    }

    public function filtrarPorPrecio(Request $request)
    {
        $categorias = Categoria::get();


        $precio_range = $request->input('precio_range', 0);

        $productos = Producto::where('precio', '<=', $precio_range)
            ->orderBy('precio', 'asc')
            ->simplePaginate(12)
            ->withQueryString();

        $ultimosProductos = Producto::latest()->take(2)->get();
        return view('frontend.paginas.productosFiltroPrecio', compact('productos', 'categorias', 'ultimosProductos'));
    }
}
