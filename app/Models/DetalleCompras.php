<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompras extends Model
{
    use HasFactory;

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'detalle_pedidos';

    // Nombres de las columnas que son modificables
    protected $fillable = [
        'cant_producto',
        'subtotal',
        'id_pedido'
    ];

    // INNER JOIN 
    public function productos()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
        // INNER JOIN 
    }
    public function pedido()
    {
        return $this->belongsTo(Pedido::class, 'id_pedido');
    }
    // INNER JOIN 
    public function user()
    {
        return $this->belongsTo(User::class, 'id_cliente');
    }
}
