<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Estados de Venta
    const PENDIENTE = 0;
    const PAGADO = 1;
    const EN_PREPARACION = 2;
    const ENVIADO = 3;
    const CANCELADO = 4;

    // Estado de envio de factura por email
    const FACTURA_ENVIADA = 1;
    const FACTURA_NO_ENVIADA = 0;

    public function cliente() {
        $this->belongsTo(User::class, 'id_cliente');
    }

    public function empleado() {
        $this->belongsTo(User::class, 'id_empleado');
    }

    public function forma_pago() {
        $this->belongsTo(FormaPago::class, 'id_forma_pago');
    }

    // falta relacion de "ventas" -> "detalle_ventas" <- "productos"
    public function detalle_ventas() {
        
    }
}
