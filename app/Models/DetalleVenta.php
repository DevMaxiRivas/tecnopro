<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $fillable = ['id_venta', 'id_producto', 'cantidad', 'subtotal'];

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class, 'id_producto');
    }
}
