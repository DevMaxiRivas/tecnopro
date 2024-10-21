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
            
            $table->unsignedBigInteger('id_empleado')->nullable()->comment('Id del empleado que solicita la cotizacion'); // BIGINT(20)
            $table->unsignedBigInteger('id_proveedor'); // BIGINT(20)
            $table->unsignedBigInteger('id_forma_pago'); // BIGINT(20)
            $table->unsignedBigInteger('id_empleado_compra')->nullable()->comment('Id del empleado que realiza la compra'); // BIGINT(20)

            // Solicitud de Cotizacion
            $table->enum('estado_pedido', [Compra::PENDIENTE, Compra::EN_ESPERA, Compra::RECIBIDO, Compra::CANCELADO])->default(Compra::PENDIENTE)->comment('Estados de la solicitud de cotizacion');
            $table->text('url_presupuesto')->nullable()->comment('Este campo se utiliza para almacenar el presupuesto enviado por el proveedor');
            $table->text('url_factura_pedido')->nullable()->comment('Este campo se utiliza para almacenar la factura del pedido de cotizacion al proveedor');
            $table->enum('estado_email_enviado_presupuesto', [Compra::FACTURA_ENVIADA, Compra::FACTURA_NO_ENVIADA])->default(Compra::FACTURA_NO_ENVIADA);

            // Ordenes de Compra
            $table->enum('estado_compra', [Compra::PENDIENTE, Compra::ENVIADA, Compra::CONFIRMADA, Compra::FINALIZADA, Compra::CANCELADO])->nullable()->comment('Estados de la orden de compra');
            $table->text('url_factura')->nullable()->comment('Este campo se utiliza para almacenar la factura enviada al proveedor');
            $table->enum('estado_email_enviado_compra', [Compra::FACTURA_ENVIADA, Compra::FACTURA_NO_ENVIADA])->default(Compra::FACTURA_NO_ENVIADA);
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
        Schema::dropIfExists('compras');
    }
};
