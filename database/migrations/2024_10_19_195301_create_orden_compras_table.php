<?php

use App\Models\OrdenCompra;
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
        Schema::create('orden_compras', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_empleado')->nullable()->comment('Id del empleado que solicita la cotizacion'); // BIGINT(20)
            $table->unsignedBigInteger('id_proveedor'); // BIGINT(20)
            $table->unsignedBigInteger('id_forma_pago'); // BIGINT(20)
            $table->unsignedBigInteger('id_empleado_compra')->nullable()->comment('Id del empleado que realiza la compra'); // BIGINT(20)

            
            // Ordenes de Compra
            $table->enum('estado_compra', [OrdenCompra::PENDIENTE, OrdenCompra::ENVIADA, OrdenCompra::CONFIRMADA, OrdenCompra::FINALIZADA, OrdenCompra::CANCELADO])->default(OrdenCompra::PENDIENTE)->comment('Estados de la orden de compra');
            $table->text('url_factura')->nullable()->comment('Este campo se utiliza para almacenar la factura enviada al proveedor');
            $table->decimal('total', 20, 2)->nullable();

            $table->timestamps();
            
            // Creamos la FK "id_empleado" que hace referencia al "id" de la tabla "users"
            $table->foreign('id_empleado')->references('id')->on('users');
            
            // Creamos la FK "id_proveedor" que hace referencia al "id" de la tabla "proveedor"
            $table->foreign('id_proveedor')->references('id')->on('proveedores');
            
            // Creamos la FK "id_forma_pago" que hace referencia al "id" de la tabla "forma_pagos"
            $table->foreign('id_forma_pago')->references('id')->on('forma_pagos');
            
            // Creamos la FK "id_empleado_compra" que hace referencia al "id" de la tabla "users"
            $table->foreign('id_empleado_compra')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orden_compras');
    }
};
