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
            'id_categoria' => 2,
            'nombre' => 'Disco SSD Kingston 960GB',
            'descripcion' => 'Considerado un dispositivo de alto rendimiento, la unidad en estado sólido A400 de Kingston está diseñada para las personas más exigentes. Mejora de forma notable la capacidad de respuesta de su sistema, ya que alcanza velocidades de lectura/escritura de hasta 500MB/seg y 450MB/seg. Por ende, es 10 veces más rápido que un disco duro tradicional. Al estar compuesta por una memoria flash es silenciosa y posee pocas probabilidades de tener fallas.',
            'stock_disponible' => 15,
            'precio' => 99898,
            'url_imagen' => config('app.url').'/imagenes/productos/ssd.jpg'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 3,
            'nombre' => 'AMD Ryzen 5 8600g 5.3 Ghz Am5',
            'descripcion' => 'Clave en el rendimiento de tu computadora de escritorio, ya no tenés que pensar en cómo distribuir el tiempo y acciones porque ahora las tareas en simultáneo son posibles. AMD cuenta con un catálogo de productos que se adaptan a los requerimientos de todo tipo de usuarios: juegos en línea, edición a gran escala, contenido en múltiples plataformas y más.',
            'stock_disponible' => 15,
            'precio' => 350000,
            'url_imagen' => config('app.url').'/imagenes/productos/procesador.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 3,
            'nombre' => 'Intel Core I3 10105 4.4GHz con gráfica integrada',
            'descripcion' => 'Productividad y entretenimiento, todo disponible en tu computadora de escritorio. La superioridad tecnológica de INTEL es un beneficio para todo tipo de profesionales. Asegura el mejor rendimiento de las aplicaciones, de la transferencia de datos y la conexión con otros elementos tecnológicos.',
            'stock_disponible' => 8,
            'precio' => 120000,
            'url_imagen' => config('app.url').'/imagenes/productos/intel.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 2,
            'nombre' => 'SSD Kingston 1tb Nvme Pcie 4.0 M2',
            'descripcion' => 'Líder en el mercado de tecnologías, Kingston ofrece una gran variedad de dispositivos de almacenamiento. Su calidad y especialización en discos de estado sólido (SSD), de memoria y de USB cifrados la convierten una de las opciones más elegidas en el mercado internacional.',
            'stock_disponible' => 5,
            'precio' => 103000,
            'url_imagen' => config('app.url').'/imagenes/productos/ssdkingston.png'
        ]);
    }
}