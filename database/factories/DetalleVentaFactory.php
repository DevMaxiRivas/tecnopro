<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DetalleVenta;
use App\Models\Producto;
use App\Models\Venta;
use Carbon\Carbon;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleVenta>
 */
class DetalleVentaFactory extends Factory
{
    protected $model = DetalleVenta::class;

    public function definition()
    {
        $producto = Producto::inRandomOrder()->first();
        $venta = Venta::inRandomOrder()->first();
        $cantidad = $this->faker->numberBetween(1, 10);
        $subtotal = $producto->precio * $cantidad;
        $venta->total += $subtotal;
        $venta->save();

        return [
            'id_venta' => $venta->id, // Relaciona con una venta existente
            'id_producto' => $producto->id, // ID de producto, ajusta según corresponda
            'cantidad' => $cantidad ,
            'precio' => $producto->precio,
            'subtotal' => $subtotal,
        ];
    }
}
