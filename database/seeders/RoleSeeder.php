<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $rol_admin = Role::create(['name' => User::ADMINISTRADOR]);
        $rol_vendedor = Role::create(['name' => User::EMPLEADO_VENTAS]);
        $rol_compras = Role::create(['name' => User::EMPLEADO_COMPRAS]);
        $rol_cliente = Role::create(['name' => User::CLIENTE]);
    }
}
