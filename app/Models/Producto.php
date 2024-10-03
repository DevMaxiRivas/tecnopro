<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    // Estados del producto
    const ACTIVO = '1';
    const INACTIVO = '0';

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'productos';
   
    // Nombres de las columnas que son modificables
    protected $fillable = [
        'id_categoria',
        'nombre', 
        'descripcion', 
        'stock_disponible',
        'precio', 
        'url_imagen',
        'activo'
    ];
    
    // INNER JOIN con la tabla Categoria por medio de la FK id_categoria
    public function categoria() {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }

    // INNER JOIN con la tabla Users por medio de la FK id_empleado
    public function empleado() {
        return $this->belongsTo(User::class, 'id_empleado');
    }
}
