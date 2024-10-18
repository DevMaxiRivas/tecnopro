<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnvioVenta extends Model
{
    use HasFactory;

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'envio_ventas';

    // Nombres de las columnas que son modificables
    protected $fillable = [
        'id_venta',
        'name',
        'dni',
        'email',
        'telefono',
        'domicilio',
        'codigo_postal',
        'latitud',
        'longitud'
    ];

    public function venta() 
    {
        return $this->belongsTo(Venta::class, 'id_venta');
    }
}
