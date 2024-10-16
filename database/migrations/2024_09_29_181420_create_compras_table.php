<?php

use App\Models\Compra;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('compras', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_empleado')->nullable(); // BIGINT(20)
            $table->unsignedBigInteger('id_proveedor'); // BIGINT(20)
            $table->unsignedBigInteger('id_forma_pago'); // BIGINT(20)

            $table->enum('estado', [Compra::PENDIENTE, Compra::EN_ESPERA, Compra::RECIBIDO, Compra::CANCELADO])->default(Compra::PENDIENTE);
            $table->string('url_factura')->nullable();
            $table->decimal('total', 20, 2)->nullable();
            
            // Creamos la FK "id_empleado" que hace referencia al "id" de la tabla "users"
            $table->foreign('id_empleado')->references('id')->on('users');
            
            // Creamos la FK "id_proveedor" que hace referencia al "id" de la tabla "proveedor"
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            
            // Creamos la FK "id_forma_pago" que hace referencia al "id" de la tabla "forma_pagos"
            $table->foreign('id_forma_pago')->references('id')->on('forma_pagos');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compras');
    }
};
