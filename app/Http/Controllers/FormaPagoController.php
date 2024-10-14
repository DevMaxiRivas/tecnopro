<?php

namespace App\Http\Controllers;

use App\Models\FormaPago;
use Illuminate\Http\Request;

class FormaPagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formapago = FormaPago::orderBy('id', 'asc')->get();
        
        //Retornamos una vista y enviamos la variable "formapago"
        return view('panel.admin.formapago.index', compact('formapago'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $formapago = new FormaPago();
        return view('panel.admin.formapago.create', compact('formapago')); //compact(mismo nombre de la variable)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|min:3|max:45|unique:forma_pagos,nombre',
            
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'nombre.unique' => 'Ya existe una forma de pago con ese nombre.',     
        ], 
    );

        $formapago = new FormaPago();

        $formapago->nombre = $request->get('nombre');
        //$formapago->activo = FormaPago::Activo;

        $formapago->save();

        return redirect()
            ->route('formapago.index')
            ->with('alert', 'Forma de pago "' . $formapago->nombre . '" agregado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FormaPago $formapago)
    {
        return view('panel.admin.formapago.show', compact('formapago')); 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormaPago $formapago)
    {
        return view('panel.admin.formapago.edit', compact('formapago'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormaPago $formapago)
    {
        $formapago->nombre = $request->get('nombre');
        $formapago->activo = $request->get('activo');
        $formapago->update();

        return redirect()
            ->route('formapago.index')
            ->with('alert', 'FormaPago "' . $formapago->nombre . '" actualizada exitosamente.');
    }

    public function cambiarEstado(Request $request)
    { }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormaPago $formapago)
    {
       
        
    }

    
}

