<?php

namespace Database\Seeders;

use App\Models\Support;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SupportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Support::factory()->data1()->create();
        Support::factory()->data2()->create();
        Support::factory()->data3()->create();
        Support::factory()->data4()->create();
        Support::factory()->data5()->create();
        Support::factory()->data6()->create();
        Support::factory()->data7()->create();
        Support::factory()->data8()->create();
        Support::factory()->data9()->create();
        Support::factory()->data10()->create();
    }
}
