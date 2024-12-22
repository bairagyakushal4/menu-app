<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        for ($i = 1; $i <= 4; $i++) {
            DB::table('categories')->insert([
                'category_name' => 'Main Category ' . $i,
                'category_description' => 'Main Category ' . $i . ' Description',
            ]);
        }

        // sub categories
        $mainCategories = DB::table('categories')->where(function ($query) {
            $query->where('parent_category_id', 0)->orWhereNull('parent_category_id');
        })->get();

        foreach ($mainCategories as $key => $mainCategory) {
            DB::table('categories')->insert([
                'category_name' => 'Sub Category ' . ($key + 1) . ' of ' . $mainCategory->category_name,
                'category_description' => 'Sub Category ' . ($key + 1) . ' Description',
                'parent_category_id' => $mainCategory->category_id,
            ]);
        }
    }
}
