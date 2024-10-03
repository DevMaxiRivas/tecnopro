<?php

use App\Models\Producto;
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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_empleado'); // BIGINT(20)
            $table->unsignedBigInteger('id_categoria'); // BIGINT(20)
            $table->string('nombre');
            $table->text('descripcion'); // TEXT: Soporta hasta 65,535 caracteres
            $table->integer('stock_disponible');
            $table->decimal('precio', 20, 2); // DECIMAL(20, 2)
            $table->string('url_imagen', 100); // VARCHAR(100)
            $table->enum('activo', [Producto::ACTIVO, Producto::INACTIVO])->comment('1: Activo, 0: Inactivo')->default(Producto::ACTIVO);

            // Creamos la FK "id_empleado" que hace referencia al "id" de la tabla "users"
            $table->foreign('id_empleado')->references('id')->on('users');

            // Creamos la FK "id_categoria" que hace referencia al "id" de la tabla "categorias"
            $table->foreign('id_categoria')->references('id')->on('categorias');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
