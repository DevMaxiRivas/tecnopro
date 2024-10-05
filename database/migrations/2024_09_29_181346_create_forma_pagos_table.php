<?php

use App\Models\FormaPago;
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
        Schema::create('forma_pagos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre')->unique();
            $table->enum('activo', [FormaPago::ACTIVO, FormaPago::INACTIVO])->comment('1: Activo, 0: Inactivo')->default(FormaPago::ACTIVO);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('forma_pagos');
    }
};
