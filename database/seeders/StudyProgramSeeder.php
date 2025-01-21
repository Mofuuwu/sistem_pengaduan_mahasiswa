<?php

namespace Database\Seeders;

use App\Models\StudyProgram;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StudyProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        StudyProgram::factory()->data1()->create();
        StudyProgram::factory()->data2()->create();
        StudyProgram::factory()->data3()->create();
        StudyProgram::factory()->data4()->create();
        StudyProgram::factory()->data5()->create();
        StudyProgram::factory()->data6()->create();
        StudyProgram::factory()->data7()->create();
        StudyProgram::factory()->data8()->create();
    }
}
