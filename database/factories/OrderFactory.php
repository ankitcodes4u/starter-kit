<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'order' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'payment_method' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'payment_status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'items' => '{}',
            'subtotal' => $this->faker->randomFloat(2, 0, 9999999999.99),
            'shipping' => $this->faker->randomFloat(2, 0, 9999999999.99),
            'total' => $this->faker->randomFloat(2, 0, 9999999999.99),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
