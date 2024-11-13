<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        /* User::factory(1)->create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
        ]); */
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(CategoriaSeeder::class);
        $this->call(FormaPagoSeeder::class);
        $this->call(ProveedorSeeder::class);
        $this->call(ProductoSeeder::class);
        \App\Models\Venta::factory(10)->create(); // Crear 100 ventas
        \App\Models\DetalleVenta::factory(40)->create(); // Crear 300 detalles de ventas
        \App\Models\EnvioVenta::factory(10)->create(); // Crear 100 envíos
    }
}
