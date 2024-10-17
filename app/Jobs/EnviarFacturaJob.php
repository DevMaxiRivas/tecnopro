<?php

namespace App\Jobs;

use App\Mail\EnviarFacturaMailable;
use App\Models\venta;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

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
        //
        $venta = venta::find($this->id);
        $data = [
            'name' => $venta->cliente->name,
            'email' => $venta->cliente->email, // Correo del Destinatario
            'num_venta' => $venta->id,
            'fecha' => $venta->created_at,
            'fecha_pago' => $venta->updated_at,
            'urlFactura' => public_path('storage/pdfs/facturas/factura_' . $venta->id . '.pdf')
        ];

        Mail::to($data['email'])->send(new EnviarFacturaMailable($data));
    }
}