<?php

// Rutas del Panel de Administracion

use Illuminate\Support\Facades\Route;

Route::get('/', function() {
    return view('panel.index');
});