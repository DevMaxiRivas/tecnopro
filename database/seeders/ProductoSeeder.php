<?php

namespace Database\Seeders;

use App\Models\Producto;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Traemos un "empleado de ventas" de manera aleatoria de la BD y lo convertimos en un objeto de PHP.
        $empleado_ventas = User::role([User::EMPLEADO_VENTAS])->inRandomOrder()->first();

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 1,
            'nombre' => 'Memoria RAM DDR3 4gb',
            'descripcion' => 'Kingston es sinónimo de trayectoria y excelencia en el mercado tecnológico, principalmente en lo que a memorias ram refiere. Mejorar la capacidad y rendimiento de tu computadora va a ser fácil con la incorporación de una memoria de la línea ValueRAM, que cubrirá todas tus necesidades. Dispará la productividad y ejecutá tus programas y aplicaciones con mayor velocidad.',
            'stock_disponible' => 15,
            'precio' => 50000,
            'url_imagen' => config('app.url').'/imagenes/productos/ram.jpg'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 2,
            'nombre' => 'Disco Seagate HDD 1tb',
            'descripcion' => 'El Seagate ST1000DM003 es un disco duro confiable y de alto rendimiento, perfecto para ampliar el almacenamiento en tu computadora de escritorio o servidor. Con una capacidad de 1TB, te ofrece espacio suficiente para almacenar grandes volúmenes de datos, como fotos, videos, documentos y aplicaciones.',
            'stock_disponible' => 10,
            'precio' => 77400,
            'url_imagen' => config('app.url').'/imagenes/productos/hdd.jpg'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 3,
            'nombre' => 'Disco SSD Kingston 960GB',
            'descripcion' => 'Considerado un dispositivo de alto rendimiento, la unidad en estado sólido A400 de Kingston está diseñada para las personas más exigentes. Mejora de forma notable la capacidad de respuesta de su sistema, ya que alcanza velocidades de lectura/escritura de hasta 500MB/seg y 450MB/seg. Por ende, es 10 veces más rápido que un disco duro tradicional. Al estar compuesta por una memoria flash es silenciosa y posee pocas probabilidades de tener fallas.',
            'stock_disponible' => 15,
            'precio' => 99898,
            'url_imagen' => config('app.url').'/imagenes/productos/ssd.jpg'
        ]);
    }
}
