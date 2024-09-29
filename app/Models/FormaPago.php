<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormaPago extends Model
{
    use HasFactory;

    const ACTIVO = 1;
    const INACTIVO = 0;

    // Nombre de la tabla que se conecta a este Modelo
    protected $table = 'forma_pagos';

    // Nombres de las columnas que son modificables
    protected $fillable = [
        'nombre',
        'activo'
    ];
}
