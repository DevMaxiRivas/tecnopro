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

        // Permisos del admin
        Permission::create(['name' => 'lista_usuarios'])->assignRole($rol_admin);
        Permission::create(['name' => 'lista_formas_pagos'])->assignRole($rol_admin);

        // Permisos del empleado de ventas
        Permission::create(['name' => 'lista_ventas'])->syncRoles([$rol_admin, $rol_vendedor]);
        
        // Permisos del cliente
        Permission::create(['name' => 'lista_compras'])->assignRole($rol_cliente);
        
        // Permisos del empleado de compras
        Permission::create(['name' => 'lista_categorias'])->syncRoles([$rol_admin, $rol_compras]);
        Permission::create(['name' => 'lista_productos'])->syncRoles([$rol_admin, $rol_compras]);
        Permission::create(['name' => 'lista_proveedores'])->syncRoles([$rol_admin, $rol_compras]);
        Permission::create(['name' => 'lista_ordenes_compras'])->syncRoles([$rol_admin, $rol_compras]);
    }
}
