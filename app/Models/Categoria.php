<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    const ACTIVO = '1';
    const INACTIVO = '0';

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'categorias';

    // Nombres de las columnas que son modificables
    protected $fillable = [
        'nombre',
        'activo'
    ];

    // INNER JOIN con la tabla Productos
    // por medio de la FK id_categoria
    public function productos()
    {
        return $this->hasMany(Producto::class, 'id_categoria');
    }

    public static function obtenerCategorias()
    {
        $categorias = Categoria::whereHas('productos', function ($query) {
            $query->where('activo', 1);
        })->get();

        return $categorias;
    }
}
