<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    // Estados de Pedido
    const PENDIENTE = '0';
    const EN_ESPERA = '1';
    const RECIBIDO = '2';
    const CANCELADO = '3';

    // Estados de Compra
    const ENVIADA = '4';
    const CONFIRMADA = '5';
    const FINALIZADA = '6';


    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'compras';

    // Nombres de las columnas que son modificables
    protected $fillable = [
        'estado',
        'url_factura',
        'estado_pedido',
        'estado_compra',
        'id_empleado_compra',
        'id_proveedor',
        'id_forma_pago',
        'url_presupuesto',
        'url_factura_pedido',
        'total'
    ];

    // INNER JOIN con la tabla "Users" por medio de la FK "id_empleado"
    public function empleado()
    {
        return $this->belongsTo(User::class, 'id_empleado');
    }

    // INNER JOIN con la tabla "forma_pago" por medio de la FK "id_forma_pago"
    public function forma_pago()
    {
        return $this->belongsTo(FormaPago::class, 'id_forma_pago');
    }

    // INNER JOIN avanzado (compras --> detalle_compras <-- productos)
    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'detalle_compras', 'id_compra', 'id_producto')
            ->withPivot(['precio', 'cantidad', 'subtotal']); // accedo a los demas atributos de la tabla "detalle_compras"
    }

    public function detalle_compras()
    {
        return $this->hasMany(DetalleCompra::class, 'id_compra');
    }

    public function proveedor()
    {
        return $this->belongsTo(Proveedor::class, 'id_proveedor');
    }
}