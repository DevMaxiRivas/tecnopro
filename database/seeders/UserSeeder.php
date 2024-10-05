<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Mariano Chivi',
            'rol' => User::ADMINISTRADOR,
            'dni' => '40111223',
            'email' => 'admin@gmail.com',
            'domicilio' => 'Av. Siempre viva 124',
            'password' => Hash::make('12345678'),
        ])->assignRole(User::ADMINISTRADOR);

        User::create([
            'name' => 'Maximiliano Rivas',
            'rol' => User::CLIENTE,
            'dni' => '40111222',
            'email' => 'cliente@gmail.com',
            'domicilio' => 'Av. Siempre viva 123',
            'password' => Hash::make('12345678'),
        ])->assignRole(User::CLIENTE);

        User::create([
            'name' => 'Alejandra Arratia',
            'rol' => User::EMPLEADO_COMPRAS,
            'dni' => '40111223',
            'email' => 'compras@gmail.com',
            'domicilio' => 'Av. Siempre viva 123',
            'password' => Hash::make('12345678'),
        ])->assignRole(User::EMPLEADO_COMPRAS);

        User::create([
            'name' => 'Tamara Villanueva',
            'rol' => User::EMPLEADO_VENTAS,
            'dni' => '40111224',
            'email' => 'ventas@gmail.com',
            'domicilio' => 'Av. Siempre viva 123',
            'password' => Hash::make('12345678'),
        ])->assignRole(User::EMPLEADO_VENTAS);
    }
}
