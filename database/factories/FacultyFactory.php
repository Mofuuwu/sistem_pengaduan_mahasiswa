<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Faculty>
 */
class FacultyFactory extends Factory
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
            'id' => '1',
            'name' => 'Fakultas Teknik',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' => '2',
            'name' => 'Fakultas Kedokteran',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'name' => 'Fakultas Hukum',
        ]);
    }
}
