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
            'id_categoria' => 3,
            'nombre' => 'Procesador gamer Intel Core i9-12900F BX8071512900F de 16 núcleos y 5.1GHz de frecuencia',
            'descripcion' => 'Productividad y entretenimiento, todo disponible en tu computadora de escritorio. La superioridad tecnológica de INTEL es un beneficio para todo tipo de profesionales. Asegura el mejor rendimiento de las aplicaciones, de la transferencia de datos y la conexión con otros elementos tecnológicos.

            Núcleos: el corazón del procesador
            En este producto, encontrarás los núcleos, que son los encargados de ejecutar las instrucciones y actividades que le asignás a tu dispositivo. Estos tienen relación directa con dos elementos: los hilos y el modelo. Por lo tanto, a la hora de elegir un procesador, es importante que valores los tres en su conjunto.',
            'stock_disponible' => 3,
            'precio' => 756212,
            'url_imagen' => config('app.url').'/imagenes/productos/intel2.png'
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
        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 7,
            'nombre' => 'Gabinete Gamer Xpg Valor Air Mid-tower Compacto Negro',
            'descripcion' => 'Marca : Adata XPG
            - Modelo : Valor Air Compact Mid-Tower Chassis
            - P/N : VALORAIRMT-BKCWW
            - UPC : 842243026641
            - EAN : 4711085937520
            - Formatos de mother compatibles : Mini-ITX, Micro-ATX, ATX
            - Color Exterior : Negro
            - Color Interior : Negro
            - Ventana : Si
            - Fuente : No
            - Usb : USB 3.2 Gen 1 x 2
            - Audio/Mic : HD Audio x 1
            - Iluminacion : No',
            'stock_disponible' => 9,
            'precio' => 90500,
            'url_imagen' => config('app.url').'/imagenes/productos/gab.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 7,
            'nombre' => 'Gabinete Corsair 6500x Tg Mid Tower White Color Blanco',
            'descripcion' => 'UNA VISTA IMPECABLE
            Aproveche la compatibilidad de la placa base con conector inverso (ASUS BTF, MSI PROJECT ZERO) e iCUE LINK y gane la guerra a los cables de una vez por todas.

            FLUJO DE AIRE SIN CONCESIONES
            El 6500X no solo es alucinante. Los soportes para ventiladores y radiadores alrededor garantizan un flujo de aire suficiente para cualquier diseño emblemático.',
            'stock_disponible' => 5,
            'precio' => 373999,
            'url_imagen' => config('app.url').'/imagenes/productos/gab2.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 7,
            'nombre' => 'Gabinete Gamer Con Ventana Fan Led Azul Magnum Tech 436b',
            'descripcion' => 'Nuevo Gabinete gamer con ventana y cooler led azul de Magnum Tech te va a dar todo el espacio necesario para tus componentes, sin dejar de lado una buena refrigeración.
            El Magnum Tech MT-436B negro con lateral transparente de acrílico y frente con ventana y cooler led azul tiene un diseño moderno e innovador por su trasparencia delantera. Es compatible con placas madre ATX y MicroATX. Cuenta con múltiples bahías y puertos de expansión y 2 puertos USB 2.0 en el frontal.',
            'stock_disponible' => 10,
            'precio' => 51498,
            'url_imagen' => config('app.url').'/imagenes/productos/gab3.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 4,
            'nombre' => 'Tarjeta De Video Zotac Geforce Rtx 4060 Twin Edge Oc White Edition 8gb Gddr6',
            'descripcion' => 'La ZOTAC GAMING GeForce RTX 4060 8GB Twin Edge OC White Edition es una tarjeta gráfica compacta y capaz, que presenta la arquitectura NVIDIA Ada Lovelace y un diseño inspirado en la aerodinámica. Con un tamaño reducido de 2 ranuras, es una excelente opción para aquellos que desean construir una PC para juegos SFF capaz de ofrecer una velocidad de fotogramas fluida y un rendimiento de 1080p en los últimos lanzamientos de títulos.',
            'stock_disponible' => 8,
            'precio' => 505635,
            'url_imagen' => config('app.url').'/imagenes/productos/pv1.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 4,
            'nombre' => 'Tarjeta Grafica Msi Radeon Rx 6900 Xt Gaming X Trio 16g',
            'descripcion' => 'Placa de Video MSI AMD Radeon RX 6900 XT Gaming X Trio 16GB
            Consigue el cambio de juego definitivo. La tarjeta gráfica AMD Radeon™ RX 6900 XT cuenta con la revolucionaria arquitectura AMD RDNA™ 2. Ahora puedes jugar en 4K con frecuencias de cuadro ultrasuaves y con la configuración máxima. Nunca más comprometa la resolución para disfrutar de juegos fluidos y de alta frecuencia de actualización. Experimente un nuevo nivel de inmersión con la tarjeta gráfica AMD',
            'stock_disponible' => 4,
            'precio' => 3499999,
            'url_imagen' => config('app.url').'/imagenes/productos/pv2.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 4,
            'nombre' => 'Placa de video AMD Sentey Radeon RX 550 4GB GDRR5 6000mhz',
            'descripcion' => 'En el menor tiempo posible 
             Con una velocidad de memoria de 7612805 MHz los datos del procesador central se van a traducir en información comprensible en tan solo un abrir y cerrar de ojos; decodificará tantos ciclos por segundo que hará más efectiva la transmisión de datos a otros componentes. Con esta cualidad, el equipo ganará agilidad y eficiencia.

            Velocidad en cada lectura
            Como cuenta con 640 núcleos, los cálculos para el procesamiento de gráficos se realizarán de forma simultánea logrando un resultado óptimo del trabajo de la placa. Esto le permitirá ejecutar lecturas dispersas y rápidas de y hacia la GPU.

            Calidad de imagen
            Criterio fundamental a la hora de elegir una placa de video, su resolución de 5120x2880 no te defraudará. La decodificación de los píxeles en tu pantalla te harán ver hasta los detalles más ínfimos en cada ilustración.',
            'stock_disponible' => 12,
            'precio' => 135000,
            'url_imagen' => config('app.url').'/imagenes/productos/pv3.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 6,
            'nombre' => 'Fuente de alimentación para PC Aerocool Advanced Technologies Cylon 600W Full Range 600W black 110/220V',
            'descripcion' => 'Con la fuente de alimentación Aerocool Advanced Technologies 600W Full Range podrás asegurar la corriente continua y estable de tu computadora de escritorio y optimizar el funcionamiento de sus componentes.

            Control de temperatura
            A través de su sistema de refrigeración, podrás mantener la temperatura ideal de sus componentes y evitar su sobrecalentamiento.

            Sin ruido ni distracciones
            Debido a su funcionamiento silencioso, tu equipo operará minimizando el nivel de ruido, para que tu jornada sea más agradable.',
            'stock_disponible' => 20,
            'precio' => 120000,
            'url_imagen' => config('app.url').'/imagenes/productos/fuente1.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 6,
            'nombre' => 'Sentey Solid Power Series SDP550 550 W fuente de alimentación para pc negra 220v',
            'descripcion' => 'Con la fuente de alimentación Sentey SDP550 podrás asegurar la corriente continua y estable de tu computadora de escritorio y optimizar el funcionamiento de sus componentes.

            Control de temperatura
            A través de su sistema de refrigeración, podrás mantener la temperatura ideal de sus componentes y evitar su sobrecalentamiento.

            Sin ruido ni distracciones
            Debido a su funcionamiento silencioso, tu equipo operará minimizando el nivel de ruido, para que tu jornada sea más agradable.',
            'stock_disponible' => 13,
            'precio' => 76499,
            'url_imagen' => config('app.url').'/imagenes/productos/fuente2.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 6,
            'nombre' => 'Fuente Msi Mpg A650gf 650w 80 Plus Gold Full Modular Mineria',
            'descripcion' => 'Con la fuente de alimentación Aerocool Advanced Technologies 600W Full Range podrás asegurar la corriente continua y estable de tu computadora de escritorio y optimizar el funcionamiento de sus componentes.

            Control de temperatura
            A través de su sistema de refrigeración, podrás mantener la temperatura ideal de sus componentes y evitar su sobrecalentamiento.',
            'stock_disponible' => 8,
            'precio' => 179279,
            'url_imagen' => config('app.url').'/imagenes/productos/fuente3.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 1,
            'nombre' => 'Memoria Ram Fury Beast Rgb Ddr4 3200mt/s 8gb Kf432c16bb2a/8',
            'descripcion' => 'La Memoria Ram Fury Beast Rgb Ddr4 3200mt/s 8gb Kf432C16BB2A/8 es una pieza esencial para mejorar el rendimiento y estilo de tu sistema. Diseñada por Kingston, un fabricante líder en la industria, esta memoria RAM cuenta con una capacidad individual de 8 GB y una velocidad impresionante de 3200 MHz. Su formato DIMM la hace perfecta para computadoras de escritorio. Además, es ideal para gamers, gracias a su alta capacidad y velocidad que permiten un rendimiento óptimo en juegos de alta demanda. Su elegante color negro se complementa con una iluminación RGB, que puedes personalizar a tu gusto, añadiendo un toque de estilo a tu sistema. El modelo detallado KF432C16BB2A/8 pertenece a la línea Fury Beast, conocida por su alta calidad y rendimiento. Con una capacidad total de 8 GB y tecnología DDR4 SDRAM.',
            'stock_disponible' => 25,
            'precio' => 36400,
            'url_imagen' => config('app.url').'/imagenes/productos/ram2.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 1,
            'nombre' => 'Memoria Ram Ddr4 8gb 3600mhz Corsair Vengeance Rgb Rs C18',
            'descripcion' => 'Adaptada a tus necesidades
            Su capacidad de 8 GB distribuída en módulos de 1 x 8 GB hace de esta memoria un soporte ideal para trabajos con documentos de alta complejidad, navegación en la web con múltiples pestañas, juegos, contenidos multimedia, entre otros.

            Potenciá tu PC
            Con su tecnología DDR4 mejorará el desempeño de tu equipo, ya que opera en 3 y 4 canales, generando mayor fluidez y velocidad en la transferencia de datos. ¡Optimizá al máximo el rendimiento de tu computadora!',
            'stock_disponible' => 35,
            'precio' => 38530,
            'url_imagen' => config('app.url').'/imagenes/productos/ram3.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 8,
            'nombre' => 'Placa Madre Gigabyte B550m K Amd Am4',
            'descripcion' => 'La placa base B550M-K de Gigabyte es una placa madre diseñada para procesadores AMD Ryzen de tercera generación y posteriores. Pertenece a la serie B550, que ofrece un rendimiento sólido y características avanzadas para satisfacer las necesidades de los entusiastas y jugadores.

            La placa base B550M-K viene en formato microATX, lo que la hace ideal para sistemas compactos, sin comprometer la funcionalidad. Ofrece soporte para hasta 128 GB de memoria DDR4 de alta velocidad y cuenta con ranuras PCIe Gen 4, lo que proporciona una conectividad más rápida para tarjetas gráficas y almacenamiento.',
            'stock_disponible' => 35,
            'precio' => 119999,
            'url_imagen' => config('app.url').'/imagenes/productos/mother1.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 8,
            'nombre' => 'Motherboard Msi Mpg B550 Gaming Plus Am4 Ddr4 Usb 3.2 M.2 F',
            'descripcion' => 'MARCA: MSI
            MODELO: MPG B550 GAMING PLUS

            - Soporte para procesadores AMD Ryzen™ de tercera generación y futuros procesadores AMD Ryzen™ con actualización de BIOS
            - Soporta memoria DDR4, hasta 4400(OC) MHz
            - Experiencia de juego rápida: PCIe 4.0, Lightning Gen 4 x4 M.2 con M.2 Shield Frozr, AMD Turbo USB 3.2 GEN 2
            - Diseño de potencia mejorado: Core Boost, PWM IC digital, PCB de 2 oz de espesor de cobre, DDR4 Boost
            - Solución térmica avanzada: Diseño de disipador térmico extendido y M.2 Shield Frozr para un sistema de alto rendimiento y una experiencia de juego continua.',
            'stock_disponible' => 4,
            'precio' => 345820,
            'url_imagen' => config('app.url').'/imagenes/productos/mother2.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 8,
            'nombre' => 'Motherboard Asus Prime X670 P Am5 Ddr5 Amd Ryzen',
            'descripcion' => 'MOTHER X670-P ASUS PRIME AM5
            X670-P
            Las placas base de la serie ASUS Prime están diseñadas para liberar todo el potencial de los procesadores de la serie AMD Ryzen 7000. Con un diseño de alimentación robusto, soluciones de refrigeración integrales y opciones de ajuste inteligentes, PRIME X670-P ofrece a los usuarios y a los constructores de PC una gama de optimizaciones de rendimiento a través de funciones intuitivas de software y firmware.',
            'stock_disponible' => 4,
            'precio' => 408820,
            'url_imagen' => config('app.url').'/imagenes/productos/mother3.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 5,
            'nombre' => 'Monitor Full Hd Benq Gw2480 Ips 24 Eye-care Bisel Delgado Color Negro',
            'descripcion' => 'Diseño elegante y sofisticado, el monitor BenQ GW2480 de 23.8" combina biseles ultra delgados con gestión de cables oculta. Incorpora tecnología Eye-Care con baja luz azul y desempeño libre de parpadeo para una mayor comodidad de visualización, y tecnología de brillo inteligente para detalles exquisitos en cualquier entorno de iluminación.

            La tecnología LED e IPS ofrece un nuevo nivel de disfrute visual con colores auténticos, negros más profundos, mayor contraste y detalles más nítidos.',
            'stock_disponible' => 10,
            'precio' => 207339,
            'url_imagen' => config('app.url').'/imagenes/productos/monitor1.png'
        ]);
 
        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 5,
            'nombre' => 'Monitor Gamer Curvo Gigabyte 27 GS27QC Qhd 165hz Negro 220V',
            'descripcion' => 'Monitor Gamer Curvo Gigabyte 27 Gs27qc Qhd 165hz

            Descripción del producto:

            Gigabyte Gs27qc - Monitor Led - Curvado - 27" - 2560 X 1440 Qhd @ 170 Hz - Va - 250 Cd/m² - 4000:1 - 1 Ms - 2xhdmi- Displayport',
            'stock_disponible' => 3,
            'precio' => 427499,
            'url_imagen' => config('app.url').'/imagenes/productos/monitor2.png'
        ]);

        Producto::create([
            'id_empleado' => $empleado_ventas->id,
            'id_categoria' => 5,
            'nombre' => 'Monitor Eurosound Ec-cs19kn 19',
            'descripcion' => 'MONITOR EUROSOUND EC-CS19KN 19"

            FUNCIONES: Rapidez. Inclinación de pantalla. Sirve para PC como para conectar a otros artefactos.
            CARACTERÍSTICA: Su resolución de 1440*900 permite disfrutar de momentos únicos gracias a una imagen de alta fidelidad.
            VENTAJA: Gran innovación. Sus 19" te van a resultar ideales en tu vida diaria, ya sea para estudiar o trabajar. Amplia conexión para usar el monitor acorde a tus necesidades.
            BENEFICIO: Gracias a su pantalla TN vas a obtener gráficas con gran nitidez, colores vivos y atractivos.',
            'stock_disponible' => 3,
            'precio' => 99130,
            'url_imagen' => config('app.url').'/imagenes/productos/monitor3.png'
        ]);




       
        
        

 //CAT 1 - 2ALM  - ALMC PROC 4- PV 5- MONI 6- FUENTES 7- GAB 8-MOTHER
    }
}