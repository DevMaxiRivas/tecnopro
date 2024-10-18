<?php

namespace App\Http\Controllers;

use App\Jobs\EnviarFacturaJob;
use App\Mail\EnviarFacturaMailable;
use App\Mail\VentaMailable;
use App\Models\FormaPago;
use App\Models\Producto;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class VentaController extends Controller
{
    public function index()
    {
        $ventas = Venta::latest()->get();
        return view('panel.admin.ventas.empleadoventa.index', compact('ventas'));
    }

    public function pago(Request $request) //Registra el pago de un pedido
    {
        //Funcion para consultar si un pedido ya fue pagado
        $payment_id = $request->payment_id; //Id del pago, se ve en el comprobante
        $token = config('mercadopago.access_token');
        $response = Http::get("https://api.mercadopago.com/v1/payments/$payment_id" . "?access_token=$token");
        $response = json_decode($response);
        $pedido_id = $request->external_reference; //Trae el ID del pedido, que mandamos por external_reference al crear la preferencia de mercado pago
        $pedido = Venta::find($pedido_id); //busco el pedido

        //Si no se realiza el pago y se vuelve al sitio
        if (!isset($response->error)) {
            $status = $response->status;
        } else {

            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('error', 'Pedido N°' . $pedido->num_pedido . ' pago cancelado. Vuelve a intentarlo en el panel de mis compras.');
        }

        //Si se vuelve al sitio luego de pagar el pedido con mercado pago
        if ($status == "approved") {
            $pedido->estado = Venta::PAGADO; //Cambia estado del pedido
            $pedido->save(); //Guarda el pedido exitosamente
            Producto::actualizarStocks($pedido->id);
            $urlPDF = $this->generarFacturaPDF($pedido); //Genera factura 
            $pedido->url_factura = $urlPDF;
            $pedido->save(); //Guarda el pedido exitosamente

            $this->avisoPagoConfirmado($pedido->id); //Envio factura por mail
            EnviarFacturaJob::dispatch($pedido->id)->onConnection('database'); //Envio factura por mail mediante cola de trabajo 
            $pedido->email_envio_factura = $pedido->cliente->email;

            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('alert', 'Pedido N°' . $pedido->id . ' pagado exitosamente. Con N° de operación: ' . $response->id);
        } else {
            //Si no se pudo pagar, no cambia el estado del pedido a pagado
            return redirect()
                ->route('MandarDatosPaginaInicio')
                ->with('error', 'Pedido N°' . $pedido->id . ' no se pudo completar el pago. Con N° operación: ' . $response->id);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Venta $venta)
    {

        // Array con los estados y sus descripciones
        $estados = [
            Venta::PENDIENTE => 'Pendiente',
            Venta::PAGADO => 'Pagado',
            Venta::EN_PREPARACION => 'En preparación',
            Venta::ENVIADO => 'Enviado',
            Venta::CANCELADO => 'Cancelado',
        ];

        return view('panel.admin.ventas.empleadoventa.edit', compact('venta', 'estados'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Venta $empleadoventum)
    {
        $request->validate([
            'estado' => 'required|in:' . implode(',', [
                Venta::PENDIENTE,
                Venta::PAGADO,
                Venta::EN_PREPARACION,
                Venta::ENVIADO,
                Venta::CANCELADO
            ]),
        ]);

        if ($empleadoventum->estado === Venta::PAGADO && $request->get('estado') === Venta::EN_PREPARACION) {
            $empleadoventum->id_empleado = auth()->user()->id; // Asigna el ID del empleado
        }

        // Actualiza el estado y otros campos necesarios
        $empleadoventum->estado = $request->get('estado');
        $empleadoventum->update(); // Guarda los cambios

        return redirect()
            ->route('ventas.empleadoventa.index')
            ->with('alert', 'Venta "' . $empleadoventum->id . '" estado actualizado exitosamente.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Venta $venta)
    {
        //
    }
    public function pdf(Venta $venta)
    {
        $detalle_ventas = $venta->detalle_ventas;
        $cliente = $venta->cliente;
        $total = $venta->total;
        $fecha_emision = $venta->created_at;
        $fecha_vencimiento = Carbon::parse($fecha_emision)->addDays(30);
        $pdf = PDF::loadView('panel.admin.ventas.empleadoventa.pdf', compact('venta', 'detalle_ventas', 'cliente', 'total', 'fecha_vencimiento'));
        return $pdf->download('Reporte_de_Venta_' . $venta->id . '.pdf');
    }

    public function generarFacturaPDF(Venta $venta)
    { //Genero la factura una vez se pague el pedido
        $detalle_ventas = $venta->detalle_ventas;
        $cliente = $venta->cliente;
        $total = $venta->total;
        $fecha_emision = $venta->created_at;
        $fecha_vencimiento = Carbon::parse($fecha_emision)->addDays(30);
        $pdf = PDF::loadView('panel.admin.ventas.empleadoventa.pdf', compact('venta', 'detalle_ventas', 'cliente', 'total', 'fecha_vencimiento'));

        // Guardar el PDF en una carpeta dentro de storage/app/public
        $pdfPath = storage_path('app/public/pdfs/facturas/');
        $pdfFileName = 'factura_' . $venta->id . '.pdf';
        $pdf->save($pdfPath . $pdfFileName);

        // Retornar la ruta del PDF guardado
        return '/storage/pdfs/facturas/' . $pdfFileName; //Regresa la URL PUBLICA de la factura
    }

    public function avisoPedidoConfirmado(Venta $venta)
    { //Envio mail una vez se genere el pedido
        $data = [
            'name' => $venta->cliente->name,
            'email' => $venta->cliente->email, // Correo del Destinatario
            'num_venta' => $venta->id,
            'fecha' => $venta->created_at
        ];
        // Envio de mail
        Mail::to($data['email'])->send(new VentaMailable($data));
    }

    public function avisoPagoConfirmado($id_venta)
    { //Envio mail una vez se genere el pedido

        $venta = Venta::find($id_venta);
        $cliente = User::find($venta->id_cliente);
        $forma_pago = FormaPago::find($venta->id_forma_pago);

        $data = [
            'name' => $cliente->name,
            'email' => $cliente->email, // Correo del Destinatario
            'num_venta' => $venta->id,
            'fecha_pago' => $venta->updated_at,
            'metodo_pago' => $forma_pago->nombre,
            'total' => $venta->total,
            'urlFactura' => public_path('storage/pdfs/facturas/factura_' . $venta->id . '.pdf')
        ];

        // Envio de mail
        Mail::to($data['email'])->send(new EnviarFacturaMailable($data));
    }
}