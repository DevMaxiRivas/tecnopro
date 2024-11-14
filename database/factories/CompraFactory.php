<?php

namespace Database\Factories;

use App\Models\Compra;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Compra>
 */
class CompraFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Compra::class;
    public function definition(): array
    {
        return [
            // 
            'id_empleado' => 4,
            'id_proveedor' => 1,
            'id_forma_pago' => 1,
            'id_empleado_compra' => 3,
            'estado_pedido' => Compra::RECIBIDO,
            'url_presupuesto' => $this->faker->url,
            'url_factura_pedido' => $this->faker->url,
            'estado_email_enviado_presupuesto' => 1,
            'estado_compra' => Compra::FINALIZADA,
            'url_factura' => $this->faker->url,
            'estado_email_enviado_presupuesto' => 1,
            'total' => 0,
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => Carbon::parse($this->faker->dateTimeThisYear)->addDays($this->faker->numberBetween(0, 10)),
        
        ];
    }
}
