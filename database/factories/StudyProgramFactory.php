<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\StudyProgram>
 */
class StudyProgramFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
        ];
    }
    public function data1() {
        return $this->state([
            'name' => 'Teknik Informatika',
            'faculty_id' => '1',
        ]);
    }
    public function data2() {
        return $this->state([
            'name' => 'Teknik Industri',
            'faculty_id' => '1',
        ]);
    }
    public function data3() {
        return $this->state([
            'name' => 'Teknik Sipil',
            'faculty_id' => '1',
        ]);
    }
    public function data4() {
        return $this->state([
            'name' => 'Kesehatan Masyarakat',
            'faculty_id' => '2',
        ]);
    }
    public function data5() {
        return $this->state([
            'name' => 'Farmasi',
            'faculty_id' => '2',
        ]);
    }
    public function data6() {
        return $this->state([
            'name' => 'Pendidikan Dokter',
            'faculty_id' => '2',
        ]);
    }
    public function data7() {
        return $this->state([
            'name' => 'Hukum Tata Negara',
            'faculty_id' => '3',
        ]);
    }
    public function data8() {
        return $this->state([
            'name' => 'Hukum Internasional',
            'faculty_id' => '3',
        ]);
    }
}
