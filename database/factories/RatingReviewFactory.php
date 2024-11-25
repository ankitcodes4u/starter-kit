<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\RatingReview;
use Illuminate\Database\Eloquent\Factories\Factory;

class RatingReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RatingReview::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::factory(),
            'rating' => $this->faker->numberBetween(-10000, 10000),
            'review' => $this->faker->text(),
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'remarks' => $this->faker->text(),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
