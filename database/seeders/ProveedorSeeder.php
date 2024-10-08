<?php

namespace Database\Seeders;

use App\Models\Proveedor;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProveedorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Proveedor::create([
            'razon_social' => 'Full H4rd',
            'cuit' => '22345123451',
            'direccion' => 'Florida 537 - Buenos Aires',
            'telefono' => '541170799997',
            'email' => 'ventas@fullh4rd.com.ar',
            'activo' => Proveedor::ACTIVO
        ]);
    }
}
