<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\EnvioVenta;
use App\Models\Venta;
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EnvioVenta>
 */
class EnvioVentaFactory extends Factory
{
    protected $model = EnvioVenta::class;

    public function definition()
    {
        return [
            'id_venta' => Venta::inRandomOrder()->first()->id, // Ajustarlo según el número de ventas generadas
            'name' => $this->faker->name,
            'dni' => $this->faker->randomNumber(8),
            'email' => $this->faker->email,
            'telefono' => $this->faker->phoneNumber,
            'domicilio' => $this->faker->address,
            'codigo_postal' => $this->faker->postcode,
            'latitud' => $this->faker->latitude,
            'longitud' => $this->faker->longitude,
            'created_at' => $this->faker->dateTimeThisYear,
            'updated_at' => Carbon::parse($this->faker->dateTimeThisYear)->addDays($this->faker->numberBetween(0, 10)),
        ];
    }
}
