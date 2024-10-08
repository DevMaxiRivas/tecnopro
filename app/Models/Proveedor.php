<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model
{
    use HasFactory;

    // Estados del proveedor
    const ACTIVO = '1';
    const INACTIVO = '0';

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'proveedores';
   
    // Nombres de las columnas que son modificables
    protected $fillable = [
        'razon_social',
        //'cuit', 
        'direccion', 
        'telefono',
        'email', 
        'activo'
    ];

    // INNER JOIN con la tabla Compras por medio de la FK id_proveedor
    public function compras() {
        return $this->hasMany(Compra::class, 'id_proveedor'); 
    }
}
