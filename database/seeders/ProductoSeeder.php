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
            'nombre' => 'Disco SSD Kingston 960GB',
            'descripcion' => 'Considerado un dispositivo de alto rendimiento, la unidad en estado sólido A400 de Kingston está diseñada para las personas más exigentes. Mejora de forma notable la capacidad de respuesta de su sistema, ya que alcanza velocidades de lectura/escritura de hasta 500MB/seg y 450MB/seg. Por ende, es 10 veces más rápido que un disco duro tradicional. Al estar compuesta por una memoria flash es silenciosa y posee pocas probabilidades de tener fallas.',
            'stock_disponible' => 15,
            'precio' => 99898,
            'url_imagen' => config('app.url').'/imagenes/productos/ssd.jpg'
        ]);
        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 3,
            'nombre' => 'Microprocesador Intel Core i3-10105F BX8070110105F',
            'descripcion' => 'Productividad y entretenimiento, todo disponible en tu computadora de escritorio. La superioridad tecnológica de INTEL es un beneficio para todo tipo de profesionales. Asegura el mejor rendimiento de las aplicaciones, de la transferencia de datos y la conexión con otros elementos tecnológicos.',
            'stock_disponible' => 15,
            'precio' => 123.599,
            'url_imagen' => config('app.url').'/imagenes/productos/intel.jpg'
        ]);
        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 3,
            'nombre' => 'Procesador Amd Ryzen 5 8500g Radeon',
            'descripcion' => 'Clave para el rendimiento de su computadora de escritorio, ya no tendrá que pensar en cómo distribuir el tiempo y las acciones porque ahora es posible realizar tareas simultáneas.',
            'stock_disponible' => 15,
            'precio' => 288.789,
            'url_imagen' => config('app.url').'/imagenes/productos/procesador.png'
        ]);
        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 2,
            'nombre' => 'Disco Ssd 512gb Adata Legend 700 M.2 Pcie Gen3x4 Nvme C Color Azul',
            'descripcion'=>'LEGEND 700 utiliza PCIe Gen3 x4 y NVMe 1.3 para ofrecer velocidades sostenidas de lectura y escritura de hasta 2.000/1.600 MB por segundo. La especificación M.2 2280 es compatible con las plataformas Intel y AMD actuales, incluyendo computadoras de escritorio y portátiles.',
            'stock_disponible' => 15,
            'precio' => 57.898,
            'url_imagen' => config('app.url').'/imagenes/productos/ssdadata.png'
        ]);
        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 2,
            'nombre' => 'Disco sólido interno Kingston SNV2S/500G NVMe PCIe 4.0 x 4 500GB',
            'descripcion'=>'El Disco sólido interno Kingston SNV2S/500G es un SSD de alta calidad con capacidad de 500GB en color azul. Ofrece velocidades de lectura de hasta 3500 MB/s y escritura de hasta 2100 MB/s gracias a su tecnología SSD y su interfaz NVMe PCIe Gen 4x4. Su factor de forma M.2 2280 lo hace compatible con una amplia variedad de dispositivos y sistemas, facilitando su instalación. Es una excelente opción para mejorar el rendimiento de tu computadora con tiempos de carga más rápidos en aplicaciones y juegos favoritos.',
            'stock_disponible' => 15,
            'precio' => 49.713,
            'url_imagen' => config('app.url').'/imagenes/productos/ssdkingston.png'
        ]);
    }
}
