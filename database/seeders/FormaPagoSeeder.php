<?php

namespace Database\Seeders;

use App\Models\FormaPago;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FormaPagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FormaPago::create([
            'nombre' => 'Efectivo'
        ]);

        FormaPago::create([
            'nombre' => 'Transferencia'
        ]);

        FormaPago::create([
            'nombre' => 'Debito'
        ]);

        FormaPago::create([
            'nombre' => 'Credito',
            'activo' => FormaPago::INACTIVO
        ]);
    }
}
