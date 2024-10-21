<?php

namespace App\Http\Controllers;

use App\Models\Compra;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Proveedor;
use App\Models\FormaPago;

use Illuminate\Support\Facades\Storage;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compras = Compra::latest()->get();
        return view('panel.admin.compras.index', compact('compras'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $compra = new Compra();
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();
       
        //Retornamos la vista de creacion de productos, enviamos al compras y proveedores
        return view('panel.admin.compras.create', compact('formas_pagos','proveedores','compra')); //compact(mismo nombre de la variable)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_proveedor' => 'required|exists:proveedores,id',  // Verifica que el proveedor exista en la tabla 'proveedores'
            'id_forma_pago' => 'required|exists:forma_pagos,id', // Verifica que la forma de pago exista en la tabla 'formas_pagos'
           // 'total' => 'required|numeric|min:0',  // Asegúrate de que el total sea un número y sea al menos 0
        ]);

        $compra = new Compra();
        $compra->id_empleado = auth()->user()->id;
        $compra->id_proveedor = $request->get('id_proveedor');
        //dd($request->get('id_forma_pago'));
        $compra->id_forma_pago = $request->get('id_forma_pago');
        // Cuando una compra se crea, se pone en estado pendiente por defecto
        // $compras->estado=$request->get('pendiente'); 
        // $compras->url_factura = $request->get('url_factura');
        $compra->total = $request->get('total',0);
        
        // Almacena la info del producto en la BD
        $compra->save();

        return redirect()
                ->route('compras.index')
                ->with('alert', 'Compras "' . $compra->id . '" Agregado exitosamente ...');
    
    }


    /**
     * Display the specified resource.
     */
    public function show(Compra $compra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Compra $compra )
    {
        $proveedores = Proveedor::get();
        $formas_pagos = FormaPago::get();

        // Array con los estados y sus descripciones
        $estados = [
            Compra::PENDIENTE => 'Pendiente',
            Compra::EN_ESPERA => 'En espera',
            Compra::RECIBIDO => 'Recibido',
            Compra::CANCELADO => 'Cancelado',
        ];

    return view('panel.admin.compras.edit', compact('compra','proveedores','formas_pagos', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Compra $compra)
    {
    // Validar los campos (incluyendo el estado)
    $request->validate([
        'estado' => 'required|in:' . implode(',', [
            Compra::PENDIENTE,
            Compra::EN_ESPERA,
            Compra::RECIBIDO,
            Compra::CANCELADO,
        ]),
    ]);
    $compra->estado_pedido = $request->get('estado');
    // Guardar los cambios
    $compra->update();

    return redirect()
            ->route('compras.index')
            ->with( 'alert', 'Compra "' . $compra->id . '" estado actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Compra $compra)
    {
        //
    }
    public function pdf(Compra $compra)
    {
        $subtotal = 0;
        $detalle_compras = $compra->detalle_compras;
        $proveedor = $compra->proveedores;
        
        foreach ($detalle_compras as $detalle) {
            $subtotal += $detalle->subtotal; 
        }

        $iva = $subtotal * 0.21;
        $total = $subtotal + $iva;
        $fecha_emision = $compra->created_at;
        $fecha_vencimiento = \Carbon\Carbon::parse($fecha_emision)->addDays(30);
        
        $pdf = PDF::loadView('panel.admin.compras.pdf', compact('compra', 'detalle_compras','proveedor','subtotal','total','iva','fecha_vencimiento'));
        
        $filename = 'cotizacion_' . $compra->id . '.pdf';
    
        // Guarda el archivo en la carpeta deseada
        $pdf->save(storage_path('app/public/cotizaciones/' . $filename)); // Asegúrate de que esta carpeta exista
    
        // Guarda la URL en el modelo de Compra
        $compra->url_factura_pedido = asset('storage/cotizaciones/' . $filename); // Guarda la URL
        $compra->save(); // No olvides guardar los cambios en la base de datos

        return $pdf->download('Cotizaciones' . $compra->id . '.pdf');
    }




    public function CotizacionIndex(){
        $compras = Compra::latest()->get();
        return view('panel.admin.cotizaciones.index',compact('compras')); 
    } 
    public function solicitarCotizacion(Compra $compra){
        return view('panel.admin.cotizaciones.solicitud',compact('compra')); 
    }
    public function StoreCotizacion(Request $request, Compra $compra) {

        $request->validate([
            'url_presupuesto' => 'nullable|file|mimes:jpg,png', // Validación para JPG/PNG 
        ],[
            'url_presupuesto.mimes' => 'Formato de archivo incorrecto',
        ]);

        if ($request->hasFile('url_presupuesto')) {
            $image_url = $request->file('url_presupuesto')->store('public/presupuestos');
            if (!$image_url) {
                return response()->json(['error' => 'No se pudo almacenar el archivo.'], 500);
            }
            $compra->url_presupuesto = asset(str_replace('public', 'storage', $image_url));
        } else {
            $compra->url_presupuesto = '';
        }

        // Almacena la info en la BD
        $compra->update();
        //dd($compra->url_presupuesto);

        return redirect()
            ->route('compras.CotizacionIndex')
           ->with('alert', 'Presupuesto subido exitosamente.');
    }


    public function descargarImagen($id_compra) 
    {
        $compra = Compra::findOrFail($id_compra); 

        if (empty($compra->url_presupuesto)) {
            return redirect()->back()->with('error', 'No hay presupuesto disponible en este momento');
        }
    
        $filePath = str_replace('http://127.0.0.1:8000/storage/', 'public/', $compra->url_presupuesto);
    
        // Verifica la existencia del archivo
        if (Storage::exists($filePath)) {
            return Storage::download($filePath);
        } else {
            return response()->json(['error' => 'El archivo no se encuentra.'], 404);
        }
    }
    
   
}

