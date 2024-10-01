<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class PaginaDeInicio extends Controller
{
    public function MandarDatosPaginaInicio()
    {
        $productos = Producto::where('activo', Producto::ACTIVO)->latest()->get();

        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();

        $carrusel = Producto::where('activo', Producto::ACTIVO)->inRandomOrder()->take(3)->get();

        return view('frontend.index', compact('productos', 'categorias', 'carrusel'));
    }

    public function resultadosBusqueda(Request $request)
    {

        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();

        $terminoBusqueda = $request->input('busqueda');
        $productosResultados = Producto::where('activo', Producto::ACTIVO)->where('nombre', 'like', '%' . $terminoBusqueda . '%')->simplePaginate(12)->withQueryString();

        return view('frontend.paginas.resultados_busqueda', compact('categorias', 'productosResultados', 'terminoBusqueda'));
    }

    public function MandarDatosLista()
    {
        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();


        $productos = Producto::where('activo', Producto::ACTIVO)
            ->latest()
            ->simplePaginate(24)
            ->withQueryString();

        return view('frontend.paginas.productosLista', compact('productos', 'categorias'));
    }

    public function MandarDatosCategoriaEspecifica($variable)
    {
        $productos = Producto::where('activo', Producto::ACTIVO)->latest()->take(2)->get();
        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();

        $categoria = Categoria::where('activo', Categoria::ACTIVO)->where('id', $variable)->first();
        $categoriaEspecifica = $categoria->nombre;


        $productos_especificos = Producto::where('activo', Producto::ACTIVO)
            ->where('id_categoria', $variable)
            ->latest()
            ->simplePaginate(12)
            ->withQueryString();

        return view('frontend.paginas.productosListaEspecifica', compact('productos_especificos', 'categorias', 'categoriaEspecifica'));
    }

    public function MandarDatosProductoEspecifico($id)
    {
        $producto = Producto::where('activo', Producto::ACTIVO)->find($id);
        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();

        $categoriaEspecifica = Categoria::where('activo', Categoria::ACTIVO)->find($producto->id_categoria);

        return view('frontend.paginas.productoDetalle', compact('producto', 'categorias', 'categoriaEspecifica'));
    }

    public function filtrarPorPrecio(Request $request)
    {
        $categorias = Categoria::where('activo', Categoria::ACTIVO)->get();


        $precio_range = $request->input('precio_range', 0);

        $productos = Producto::where('activo', Producto::ACTIVO)
            ->where('precio', '<=', $precio_range)
            ->orderBy('precio', 'asc')
            ->simplePaginate(12)
            ->withQueryString();

        $ultimosProductos = Producto::latest()->take(2)->get();
        return view('frontend.paginas.productosFiltroPrecio', compact('productos', 'categorias', 'ultimosProductos'));
    }
}
