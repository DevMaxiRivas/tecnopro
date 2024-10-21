<?php

namespace App\Jobs;

use App\Mail\EnviarFacturaMailable;
use App\Models\FormaPago;
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


class EnviarFacturaJob implements ShouldQueue
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
        $venta = Venta::find($this->id);
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

        Mail::to($data['email'])->send(new EnviarFacturaMailable($data));
    }
}
