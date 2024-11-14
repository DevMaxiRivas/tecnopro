<?php

namespace Database\Factories;

use App\Models\Compra;
use App\Models\DetalleCompra;
use App\Models\Producto;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetalleCompra>
 */
class DetalleCompraFactory extends Factory
{
    protected $model = DetalleCompra::class;

    public function definition()
    {
        $producto = Producto::inRandomOrder()->first();
        $compra = Compra::inRandomOrder()->first();
        $cantidad = $this->faker->numberBetween(1, 10);
        $subtotal = $producto->precio * $cantidad;
        $compra->total += $subtotal;
        $compra->save();

        return [
            'id_compra' => $compra->id, // Relaciona con una venta existente
            'id_producto' => $producto->id, // ID de producto, ajusta según corresponda
            'precio' => $producto->precio,
            'cantidad' => $cantidad ,
            'subtotal' => $subtotal,
            'estado'=>DetalleCompra::ACTIVO,
        ];
    }
}
