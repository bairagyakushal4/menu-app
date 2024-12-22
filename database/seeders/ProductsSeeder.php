<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = DB::table('categories')->where('parent_category_id', '>', 0)->pluck('category_id')->toArray();

        $faker = \Faker\Factory::create();

        for ($i = 1; $i <= 20; $i++) {
            DB::table('products')->insert([
                'product_sku' => $faker->unique()->regexify('[A-Z]{3}[0-9]{3}'),
                'product_name' => $faker->unique()->word(),
                'product_description' => $faker->paragraph(),
                'product_price' => $faker->numberBetween(100, 1000),
                'product_veg_non_veg' => $faker->randomElement(['veg', 'non_veg', 'na']),
                'category_id' => $faker->randomElement($categories),
            ]);
        }
    }
}
