<?php

namespace Database\Factories;

use App\Models\Request;
use Illuminate\Database\Eloquent\Factories\Factory;

class RequestFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Request::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'contact' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'subject' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'images' => '{}',
            'message' => $this->faker->text(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'remarks' => $this->faker->text(),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
