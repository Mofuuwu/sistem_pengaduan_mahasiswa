<?php

namespace Database\Seeders;

use App\Models\Attachment;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttachmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Attachment::factory()->data1()->create();
        Attachment::factory()->data2()->create();
        Attachment::factory()->data3()->create();
        Attachment::factory()->data4()->create();
        Attachment::factory()->data5()->create();
        Attachment::factory()->data6()->create();
        Attachment::factory()->data7()->create();
        Attachment::factory()->data8()->create();
        Attachment::factory()->data9()->create();
        Attachment::factory()->data10()->create();
        Attachment::factory()->data11()->create();
        Attachment::factory()->data12()->create();
    }
}
