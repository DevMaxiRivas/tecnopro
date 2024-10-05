<?php

namespace App\Http\Controllers;

use App\Models\RegProveedor;
use Illuminate\Http\Request;

class RegProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $regproveedor = RegProveedor::latest()->get();
        
        //Retornamos una vista y enviamos la variable "categorias"
        return view('panel.admin.regproveedor.index', compact('regproveedor'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $regproveedor = new RegProveedor();
        return view('panel.admin.regproveedor.create', compact('regproveedor')); //compact(mismo nombre de la variable)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|unique:regproveedor,nombre',
        ], [
            'nombre.required' => 'El campo nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.unique' => 'Ya existe un proveedor con ese nombre.'
        ]);

        $regproveedor = new RegProveedor();

        $regproveedor->nombre = $request->get('nombre');
        $regproveedor->activo = $request->get('activo');

        $regproveedor->save();

        return redirect()
            ->route('regproveedor.index')
            ->with('alert', 'RegProveedor "' . $regproveedor->nombre . '" agregada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(RegProveedor $regproveedor)
    {
        return view('panel.admin.regproveedor.show', compact('regproveedor')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RegProveedor $regproveedor)
    {
        return view('panel.admin.regproveedor.edit', compact('regproveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RegProveedor $regproveedor)
    {
        $regproveedor->nombre = $request->get('nombre');
        $regproveedor->activo = $request->get('activo');

        $regproveedor->update();

        return redirect()
            ->route('regproveedor.index')
            ->with('alert', 'RegProveedor "' . $regproveedor->nombre . '" actualizada exitosamente.');
    }

    public function cambiarEstado(Request $request)
    { }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RegProveedor $regproveedor)
    {
       
        
    }
}
