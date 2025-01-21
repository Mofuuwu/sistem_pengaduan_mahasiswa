<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AttachmentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(CollegeStudentSeeder::class);
        $this->call(ComplaintSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(LogsSeeder::class);
        $this->call(RulesSeeder::class);
        $this->call(StudyProgramSeeder::class);
        $this->call(SupportSeeder::class);
        $this->call(UserSeeder::class);
    }
}
