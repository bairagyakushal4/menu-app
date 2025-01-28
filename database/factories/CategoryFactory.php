<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_name' => "Main " . $this->faker->words(2, true),
            'category_description' => $this->faker->sentence(),
            'category_logo' => $this->faker->imageUrl(100, 100, 'business', true, 'logos'),
            'category_status' => 'active',
            'parent_category_id' => null,
        ];
    }


    public function subCategory()
    {
        return $this->state(function (array $attributes) {
            return [
                'category_name' => "Sub " . $this->faker->words(2, true),
                'parent_category_id' => Category::inRandomOrder()->whereNull('parent_category_id')->first()->category_id,
            ];
        });
    }
}
