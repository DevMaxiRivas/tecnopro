<?php

namespace App\Jobs;

use App\Mail\EnviarSolicitudCotizacionMailiable;
use App\Models\Compra;
use App\Models\FormaPago;
use App\Models\Proveedor;
use App\Models\User;
use App\Models\Venta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;


class EnviarSolicitudCotizacionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public $id;
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $orden = Compra::where('id', $this->id)->first();
        $proveedor = Proveedor::where('id', $orden->id_proveedor)->first();

        $data = [
            'proveedor' => $proveedor->razon_social,
            'email' => $proveedor->email, // Correo del Destinatario
            'urlFactura' => public_path('storage/cotizaciones/cotizacion_' . $orden->id . '.pdf')
        ];

        // Actualizo estado de envio de correo
        $orden->estado_email_enviado_presupuesto = Compra::FACTURA_ENVIADA;
        $orden->save();

        Mail::to($data['email'])->send(new EnviarSolicitudCotizacionMailiable($data));
    }
}
