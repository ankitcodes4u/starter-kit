<?php

namespace Database\Factories;

use App\Models\Attribute;
use Illuminate\Database\Eloquent\Factories\Factory;

class AttributeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Attribute::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'values' => '{}',
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
