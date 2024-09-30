<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::latest()->get();
        //Retornamos una vista y enviamos la variable "categorias"
        return view('panel.admin.categorias.index', compact('categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categoria = new Categoria();
        return view('panel.admin.categorias.create', compact('categoria')); //compact(mismo nombre de la variable)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $categoria = new Categoria();
        $categoria->nombre = $request->get('nombre');
        $categoria->activo = $request->get('activo');
        $request->validate([
            'nombre' => 'required|min:3',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
        ]);

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
       // return view('panel.admin.categorias.show', compact('categoria')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categoria $categoria)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
    }

    public function cambiarEstado(Request $request)
    { }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        //
    }
}
