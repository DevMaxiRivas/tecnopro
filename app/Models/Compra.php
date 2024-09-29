<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Compra extends Model
{
    use HasFactory;

    // Estados de Compra
    const PENDIENTE = 0;
    const PAGADO = 1;
    const EN_PREPARACION = 2;
    const RECIBIDO = 3;
    const CANCELADO = 4;

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'compras';

    // Nombres de las columnas que son modificables
    protected $fillable = [
        'estado',
        'url_factura',
        'total'
    ];

    // INNER JOIN con la tabla "Users" por medio de la FK "id_empleado"
    public function empleado() {
        $this->belongsTo(User::class, 'id_empleado');
    }

    // INNER JOIN con la tabla "forma_pago" por medio de la FK "id_forma_pago"
    public function forma_pago() {
        $this->belongsTo(FormaPago::class, 'id_forma_pago');
    }

    // falta relacion de "compras" -> "detalle_compras" <- "productos"
    public function detalle_compras() {
        
    }
}
