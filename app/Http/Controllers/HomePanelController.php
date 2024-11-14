<?php

namespace App\Http\Controllers;

use App\Models\Venta;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomePanelController extends Controller
{
    public function index()
    {
        $ganancias = Venta::whereIn('estado', [Venta::PAGADO, Venta::ENVIADO, Venta::ENTREGADO])
                            ->sum('total');

        return view('panel.index', compact('ganancias'));
    }

    public function ganancias(Request $request) 
    {
        // Si se hace una petición AJAX
        if (request()->ajax()) {
            // Recibir los parámetros de inicio y fin en formato MM/YYYY
            $inicio = $request->input('start_date'); // Ejemplo: '01/2024'
            $fin = $request->input('end_date'); // Ejemplo: '03/2024'

            // Convertir las fechas de MM/YYYY a timestamps
            $fechaInicio = Carbon::createFromFormat('m/Y', $inicio)->startOfMonth();
            $fechaFin = Carbon::createFromFormat('m/Y', $fin)->endOfMonth();

            // Consultar las ventas en el rango de fechas y agrupar por mes y año
            $ventasPorMes = Venta::whereBetween('created_at', [$fechaInicio, $fechaFin])
                ->select(
                    DB::raw('YEAR(created_at) as anio'),
                    DB::raw('MONTH(created_at) as mes'),
                    DB::raw('SUM(total) as total_ganancias')
                )
                ->groupBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                ->orderBy(DB::raw('YEAR(created_at), MONTH(created_at)'))
                ->get();

            $response = [
                'success' => true,
                'data' => $ventasPorMes,
            ];

            return json_encode($response);
        }
    }
}
