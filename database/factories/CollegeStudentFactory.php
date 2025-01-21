<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CollegeStudent>
 */
class CollegeStudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
        ];
    }
    public function data1() {
        return $this->state([
            'nim' => '9182918291',
            'study_program_id' => '2',
            'faculty_id' => '1',
            'address' => 'Jl. Raya Pancurawiswis',
            'phone_number' => '082716272616',
            'dob' => '2025-01-10',
            'user_id' => '3',
        ]);
    }
    public function data2() {
        return $this->state([
            'nim' => '9291829288',
            'study_program_id' => '5',
            'faculty_id' => '2',
            'address' => 'Jl. Raya Kedungbanteng',
            'phone_number' => '019319281928',
            'dob' => '2025-01-10',
            'user_id' => '2',
        ]);
    }
}
