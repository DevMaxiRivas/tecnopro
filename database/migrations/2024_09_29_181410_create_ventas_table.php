<?php

use App\Models\Venta;
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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('id_forma_pago'); // BIGINT(20)
            $table->unsignedBigInteger('id_cliente'); // BIGINT(20)
            $table->unsignedBigInteger('id_empleado')->nullable(); // BIGINT(20)

            $table->enum('estado', [Venta::PENDIENTE, Venta::PAGADO, Venta::EN_PREPARACION, Venta::ENVIADO, Venta::CANCELADO])->default(Venta::PENDIENTE);
            $table->string('url_factura')->nullable();
            $table->decimal('total', 20, 2); // DECIMAL(20, 2)
            $table->string('link_pago')->nullable();
            $table->string('email_envio_factura')->nullable();
            $table->enum('estado_factura', [Venta::FACTURA_ENVIADA, Venta::FACTURA_NO_ENVIADA])->nullable();

            // Creamos la FK "id_forma_pago" que hace referencia al "id" de la tabla "forma_pagos"
            $table->foreign('id_forma_pago')->references('id')->on('forma_pagos');

            // Creamos la FK "id_cliente" que hace referencia al "id" de la tabla "users"
            $table->foreign('id_cliente')->references('id')->on('users');

            // Creamos la FK "id_empleado" que hace referencia al "id" de la tabla "users"
            $table->foreign('id_empleado')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
