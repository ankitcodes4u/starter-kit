<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'parent_id' => Category::factory(),
            'image' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'name' => $this->faker->name(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
