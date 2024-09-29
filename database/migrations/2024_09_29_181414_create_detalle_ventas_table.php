<?php

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
        Schema::create('detalle_ventas', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_venta'); // BIGINT(20)
            $table->unsignedBigInteger('id_producto'); // BIGINT(20)

            $table->decimal('precio', 10, 2); // DECIMAL(10, 2)
            $table->integer('cantidad');
            $table->decimal('subtotal', 10, 2); // DECIMAL(10, 2)

            // Creamos la FK "id_venta" que hace referencia al "id" de la tabla "ventas"
            $table->foreign('id_venta')->references('id')->on('ventas');

            // Creamos la FK "id_producto" que hace referencia al "id" de la tabla "productos"
            $table->foreign('id_producto')->references('id')->on('productos');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_ventas');
    }
};
