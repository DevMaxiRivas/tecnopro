<?php

namespace Database\Seeders;

use App\Models\User;
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
    }
}
