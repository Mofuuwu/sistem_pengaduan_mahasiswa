<?php

namespace Database\Seeders;

use App\Models\Location;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Location::factory()->data1()->create();
        Location::factory()->data2()->create();
        Location::factory()->data3()->create();
        Location::factory()->data4()->create();
        Location::factory()->data5()->create();
    }
}
