<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    // Estados de Venta
    const PENDIENTE = '0';
    const PAGADO = '1';
    const EN_PREPARACION = '2';
    const ENVIADO = '3';
    const CANCELADO = '4';

    // Estado de envio de factura por email
    const FACTURA_ENVIADA = '1';
    const FACTURA_NO_ENVIADA = '0';

    public function cliente() {
        return $this->belongsTo(User::class, 'id_cliente');
    }

    public function empleado() {
        return $this->belongsTo(User::class, 'id_empleado');
    }

    public function forma_pago() {
        return $this->belongsTo(FormaPago::class, 'id_forma_pago');
    }

    // INNER JOIN avanzado (ventas --> detalle_ventas <-- productos)
    public function productos() {
        return $this->belongsToMany(Producto::class, 'detalle_ventas', 'id_venta', 'id_producto')
        ->withPivot(['precio','cantidad', 'subtotal']); // accedo a los demas atributos de la tabla "detalle_ventas"
    }

    public function detalle_ventas() {
        return $this->hasMany(DetalleVenta::class, 'id_venta');
    }
}
