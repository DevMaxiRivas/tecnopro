<?php
namespace App\Http\Controllers;

use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VentaclienteController extends Controller
{
    /**
     * Muestra una lista de las compras del cliente autenticado.
     */
    public function index()
    {
        // Obtener el cliente autenticado
        $clienteId = Auth::id();

        // Obtener las ventas que pertenecen al cliente autenticado
        $ventas = Venta::where('id_cliente', $clienteId)->get();

        // Retornar la vista con las ventas
        return view('panel.admin.ventas.index', compact('ventas'));
    }

    /**
     * Muestra los detalles de una venta específica.
     */
    public function show($id)
    {
        // Buscar la venta por ID y asegurarse de que pertenece al cliente autenticado
        $ventas = Venta::where('id', $id)->where('id_cliente', Auth::id())->firstOrFail();

        // Retornar la vista con los detalles de la venta
        return view('panel.admin.ventas.show', compact('detalle_ventas'));
    }
}


