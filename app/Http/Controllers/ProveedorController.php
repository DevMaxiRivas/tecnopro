<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proveedor = Proveedor::latest()->get();
        
        //Retornamos una vista y enviamos la variable "proveedor"
        return view('panel.admin.proveedor.index', compact('proveedor'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proveedor = new Proveedor();
        return view('panel.admin.proveedor.create', compact('proveedor')); //compact(mismo nombre de la variable)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'razon_social' => 'required|min:3|max:45|unique:proveedores,razon_social',
            'cuit'=>'required|min:11|max:11|integer|unique:proveedores,cuit',

        ], [
            'razon_social.required' => 'El campo razon social es obligatorio.',
            'razon_social.min' => 'La razon social debe tener al menos 3 caracteres.',
            'razon_social.unique' => 'Ya existe un proveedor con esa razon social.',
            'cuit.required' => 'El campo CUIT es obligatorio.',
            
        ], 
        
    
    );

        $proveedor = new Proveedor();

        $proveedor->razon_social = $request->get('razon_social');
        $proveedor->cuit = $request->get('cuit');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        //$proveedor->activo = Proveedor::Activo;

        $proveedor->save();

        return redirect()
            ->route('proveedor.index')
            ->with('alert', 'Proveedor "' . $proveedor->razon_social . '" agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Proveedor $proveedor)
    {
        return view('panel.admin.proveedor.show', compact('proveedor')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        return view('panel.admin.proveedor.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        $proveedor->razon_social = $request->get('razon_social');
        $proveedor->activo = $request->get('activo');
        $proveedor->cuit = $request->get('cuit');
        $proveedor->direccion = $request->get('direccion');
        $proveedor->telefono = $request->get('telefono');
        $proveedor->email = $request->get('email');
        $proveedor->update();

        return redirect()
            ->route('proveedor.index')
            ->with('alert', 'Proveedor "' . $proveedor->razon_social . '" actualizada exitosamente.');
    }

    public function cambiarEstado(Request $request)
    { }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
       
        
    }
}

