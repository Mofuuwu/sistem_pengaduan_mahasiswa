<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    
    public function run(): void
    {
        Category::factory()->data1()->create();
        Category::factory()->data2()->create();
        Category::factory()->data3()->create();
        Category::factory()->data4()->create();
        Category::factory()->data5()->create();
    }
}
