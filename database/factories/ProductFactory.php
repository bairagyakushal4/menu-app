<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;


/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        $category_ids = \App\Models\Category::where('parent_category_id', '>', 0)
            ->pluck('category_id')
            ->toArray();

        return [
            'product_sku' => $this->faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
            'product_image' => $this->faker->optional()->imageUrl(),
            'product_name' => $this->faker->words(4, true),
            'product_description' => $this->faker->sentence(),
            'product_price' => $this->faker->randomFloat(0, 100000, 2),
            'product_veg_non_veg' => $this->faker->randomElement(['veg', 'non_veg', 'na']),
            'product_status' => $this->faker->randomElement(['active', 'disabled']),
            'category_id' => $this->faker->randomElement($category_ids),
        ];
    }
}
