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
        Schema::create('detalle_compras', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_compra'); // BIGINT(20)
            $table->unsignedBigInteger('id_producto'); // BIGINT(20)

            $table->decimal('precio', 20, 2)->nullable();
            $table->integer('cantidad');
            $table->decimal('subtotal', 20, 2)->nullable();

            // Creamos la FK "id_compra" que hace referencia al "id" de la tabla "compras"
            $table->foreign('id_compra')->references('id')->on('compras');

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
        Schema::dropIfExists('detalle_compras');
    }
};
