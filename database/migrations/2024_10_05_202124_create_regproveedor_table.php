<?php

use App\Models\RegProveedor;
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
        Schema::create('regproveedor', function (Blueprint $table) {
         $table->id();
         $table->string('nombre');
         $table->enum('activo', [RegProveedor::ACTIVO, RegProveedor::INACTIVO])->comment('1: Activo, 0: Inactivo');
         $table->timestamps();
     });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('regproveedor');
    }
};
