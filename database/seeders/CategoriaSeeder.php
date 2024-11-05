<?php

namespace Database\Seeders;

use App\Models\Categoria;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Categoria::create([
            'nombre' => 'Memorias RAM'
        ]);

        Categoria::create([
            'nombre' => 'Almacenamiento'
        ]);

        Categoria::create([
            'nombre' => 'Procesadores'
        ]);

        Categoria::create([
            'nombre' => 'Placas de video'
        ]);

        Categoria::create([
            'nombre' => 'Monitores'
        ]);
        Categoria::create([
            'nombre' => 'Fuentes de alimentación'
        ]);
        Categoria::create([
            'nombre' => 'Gabinetes'
        ]);
        Categoria::create([
            'nombre' => 'Motherboards'
        ]);
    }
}

/*1-RAM
2-ALMACENAMIENTO
3-PROCESADORES
4-PLACAS DE VIDEO
5-MONITORES
6-FUENTE DE ALIMENTACIÓN
7-GABINETES
8-MOTHERBOARS
*/
