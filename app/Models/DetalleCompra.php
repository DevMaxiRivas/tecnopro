<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCompra extends Model
{
    use HasFactory;
    
    // Estados del producto en el detalle
    const ACTIVO = '1';
    const INACTIVO = '0';

    protected $table = 'detalle_compras';

    protected $fillable = [
        'id_producto',
        'precio',
        'cantidad',
        'subtotal',
        'estado'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}