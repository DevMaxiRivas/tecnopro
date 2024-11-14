<?php

namespace Database\Factories;

use App\Models\Venta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Venta>
 */
class VentaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Venta::class;
    public function definition(): array
    {
        return [
            // 
            'id_forma_pago' => 1, // Asumiendo 4 formas de pago diferentes
            'id_cliente' => 2,
            'id_empleado' => 4,
            'estado' => Venta::ENVIADO,
            'url_factura' => $this->faker->url,
            'total' => 0,
            'link_pago' => $this->faker->url,
            'email_envio_factura' => $this->faker->email,
            'estado_factura' => Venta::FACTURA_ENVIADA,
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => Carbon::parse($this->faker->dateTimeThisYear)->addDays($this->faker->numberBetween(0, 10)),
        
        ];
    }
}
