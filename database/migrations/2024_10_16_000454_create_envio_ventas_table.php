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
        Schema::create('envio_ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_venta'); // BIGINT(20)
            $table->string('name')->comment('Nombre completo de la persona que recibe el paquete'); 
            $table->integer('dni');
            $table->string('email');
            $table->string('telefono');
            $table->string('domicilio');
            $table->string('codigo_postal');
            $table->string('latitud')->nullable();
            $table->string('longitud')->nullable();
            $table->timestamps();

            // Creamos la FK "id_venta" que hace referencia al "id" de la tabla "ventas"
            $table->foreign('id_venta')->references('id')->on('ventas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envio_ventas');
    }
};
