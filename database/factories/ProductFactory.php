<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'hsn_code' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'images' => '{}',
            'videos' => '{}',
            'link' => $this->faker->regexify('[A-Za-z0-9]{500}'),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomFloat(2, 0, 9999999999.99),
            'bulk_price' => '{}',
            'brand_id' => Brand::factory(),
            'category_id' => Category::factory(),
            'unit_id' => Unit::factory(),
            'minimum_order_quantity' => $this->faker->numberBetween(-10000, 10000),
            'attributes' => '{}',
            'badge' => '{}',
            'overview' => $this->faker->text(),
            'description' => $this->faker->text(),
            'faq' => $this->faker->text(),
            'refundable' => $this->faker->boolean(),
            'warranty' => $this->faker->boolean(),
            'meta_title' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'meta_keywords' => $this->faker->regexify('[A-Za-z0-9]{500}'),
            'meta_description' => $this->faker->regexify('[A-Za-z0-9]{500}'),
            'additional' => '{}',
            'status' => $this->faker->regexify('[A-Za-z0-9]{255}'),
            'remarks' => $this->faker->text(),
            'created_by' => $this->faker->randomNumber(),
            'updated_by' => $this->faker->randomNumber(),
        ];
    }
}
