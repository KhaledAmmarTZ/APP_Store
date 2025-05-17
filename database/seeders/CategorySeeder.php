<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['category_name' => 'Games', 'category_description' => 'Fun and entertainment mobile games'],
            ['category_name' => 'Productivity', 'category_description' => 'Apps to boost your productivity'],
            ['category_name' => 'Education', 'category_description' => 'Learning and educational apps'],
            ['category_name' => 'Health & Fitness', 'category_description' => 'Health tracking and fitness apps'],
            ['category_name' => 'Finance', 'category_description' => 'Personal finance and budgeting apps'],
            ['category_name' => 'Social', 'category_description' => 'Social networking and communication apps'],
            ['category_name' => 'Photography', 'category_description' => 'Photo editing and camera apps'],
            ['category_name' => 'Music & Audio', 'category_description' => 'Music streaming and audio tools'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}
