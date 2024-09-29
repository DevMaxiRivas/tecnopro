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
            'name' => 'Maxi Rivas',
            'rol' => User::CLIENTE,
            'dni' => '40111222',
            'email' => 'cliente@gmail.com',
            'domicilio' => 'Av. Siempre viva 123',
            'password' => Hash::make('12345678'),
        ])->assignRole(User::CLIENTE);

        User::create([
            'name' => 'Marian Chivi',
            'rol' => User::ADMINISTRADOR,
            'dni' => '40111223',
            'email' => 'admin@gmail.com',
            'domicilio' => 'Av. Siempre viva 124',
            'password' => Hash::make('12345678'),
        ])->assignRole(User::ADMINISTRADOR);
    }
}
