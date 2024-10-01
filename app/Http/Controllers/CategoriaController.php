<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categoria = Categoria::latest()->get();

    
        return view('panel.admin.categorias.index', compact('categoria'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('panel.admin.categorias.create', compact('categoria'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->activo = $request->get('activo');

        // Almacena la info del producto en la BD
        $categoria->save();
        return redirect()
            ->route('categoria.index')
            ->with('alert', 'Categoria "' . $categoria->nombre . '" agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Categoria $categoria)
    {
        return view('panel.admin.categorias.show', compact('categoria')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
        return view('panel.admin.categorias.edit', compact('categoria'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $categoria->nombre = $request->get('nombre');
        $categoria->activo = $request->get('activo');

        
        $categoria->update();

        return redirect()
            ->route('categoria.index')
            ->with('alert', 'Categoria "' . $categoria->nombre . '" actualizada exitosamente.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
       
        
    }
}
