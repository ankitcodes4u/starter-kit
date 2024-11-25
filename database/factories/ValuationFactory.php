<?php

namespace Database\Factories;

use App\Models\Valuation;
use Illuminate\Database\Eloquent\Factories\Factory;

class ValuationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Valuation::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'hsn_code' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'units' => '{}',
            'price' => $this->faker->randomFloat(2, 0, 9999999999.99),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
