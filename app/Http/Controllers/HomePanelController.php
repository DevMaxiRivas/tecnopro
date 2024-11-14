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
        $now = Carbon::now();

        $ganancias = Venta::whereIn('estado', [Venta::PAGADO, Venta::ENVIADO, Venta::ENTREGADO])
                            ->whereMonth('created_at', $now->month)  // Filtrar por el mes actual
                            ->whereYear('created_at', $now->year)   // Filtrar por el año actual
                            ->sum('total');

        return view('panel.index', compact('ganancias'));
    }

    public function ganancias(Request $request) 
    {
        // Recibir los parámetros de inicio y fin en formato MM/YYYY
        $inicio = $request->input('start_date'); // Ejemplo: '01/2024'
        $fin = $request->input('end_date'); // Ejemplo: '03/2024'

        $labels = [];
        $counts = [];

        // Establecer la localización en español
        // setlocale(LC_TIME, 'es_ES.UTF-8', 'Spanish_Spain', 'es_ES', 'es');

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
            
        foreach ($ventasPorMes as $venta) {
            // $monthNumber = $venta->mes;
            // $monthName = strftime('%B', mktime(0, 0, 0, $monthNumber, 1));  // Nombre del mes en español
            // $labels[] = ucfirst($monthName).'/'.$venta->anio;  // Capitalizar la primera letra
            $labels[] = $venta->mes .'/'. $venta->anio;
            $counts[] = $venta->total_ganancias;
        }
        
        $response = [
            'success' => count($ventasPorMes) > 0,
            'data' => [$labels, $counts],
            'message' => count($ventasPorMes) == 0 ? 'No se encontraron ganancias en el rango solicitado ' : ''
        ];

        return json_encode($response);
    }
}
