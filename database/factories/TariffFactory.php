<?php

namespace Database\Factories;

use App\Models\Tariff;
use Illuminate\Database\Eloquent\Factories\Factory;

class TariffFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tariff::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'hsn_code' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'description_of_goods' => $this->faker->text(),
            'units' => '{}',
            'price' => $this->faker->randomFloat(2, 0, 9999999999.99),
            'type' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
