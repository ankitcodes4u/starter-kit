<?php

namespace Database\Factories;

use App\Models\ShippingRule;
use Illuminate\Database\Eloquent\Factories\Factory;

class ShippingRuleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ShippingRule::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'hsn_code' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'rules' => '{}',
            'applied_to_all' => $this->faker->boolean(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
