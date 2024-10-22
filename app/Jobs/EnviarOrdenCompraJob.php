<?php

namespace App\Jobs;

use App\Mail\EnviarOrdenCompraMailable;
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


class EnviarOrdenCompraJob implements ShouldQueue
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
        $forma_pago = FormaPago::where('id', $orden->id_forma_pago)->first();

        $data = [
            'proveedor' => $proveedor->razon_social,
            'email' => $proveedor->email, // Correo del Destinatario
            'num_orden' => $orden->id,
            'fecha' => $orden->created_at,
            'metodo_pago' => $forma_pago->nombre,
            'total' => $orden->total,
            'urlFactura' => public_path('storage/facturas/orden_compra_' . $orden->id . '.pdf')
        ];

        $orden->estado_email_enviado_compra = Compra::FACTURA_ENVIADA;
        $orden->save();

        Mail::to($data['email'])->send(new EnviarOrdenCompraMailable($data));
    }
}
