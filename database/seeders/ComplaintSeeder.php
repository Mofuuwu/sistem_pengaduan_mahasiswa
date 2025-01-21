<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Complaint::factory()->data1()->create();
        Complaint::factory()->data2()->create();
        Complaint::factory()->data3()->create();
        Complaint::factory()->data4()->create();
        Complaint::factory()->data5()->create();
        Complaint::factory()->data6()->create();
        Complaint::factory()->data7()->create();
        Complaint::factory()->data8()->create();
        Complaint::factory()->data9()->create();
        Complaint::factory()->data10()->create();
        Complaint::factory()->data11()->create();
    }
}
