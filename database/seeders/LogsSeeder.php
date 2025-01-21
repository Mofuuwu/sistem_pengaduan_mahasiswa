<?php

namespace Database\Seeders;

use App\Models\Logs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LogsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Logs::factory()->data1()->create();
        Logs::factory()->data2()->create();
        Logs::factory()->data3()->create();
        Logs::factory()->data4()->create();
        Logs::factory()->data5()->create();
        Logs::factory()->data6()->create();
        Logs::factory()->data7()->create();
        Logs::factory()->data8()->create();
        Logs::factory()->data9()->create();
        Logs::factory()->data10()->create();
        Logs::factory()->data11()->create();
        Logs::factory()->data12()->create();
    }
}
