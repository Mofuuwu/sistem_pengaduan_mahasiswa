<?php

namespace Database\Seeders;

use App\Models\CollegeStudent;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CollegeStudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CollegeStudent::factory()->data1()->create();
        CollegeStudent::factory()->data2()->create();
    }
}
