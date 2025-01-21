<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Location>
 */
class LocationFactory extends Factory
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
            'name' => 'Toilet',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' => '2',
            'name' => 'Kelas',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'name' => 'Kantin',
        ]);
    }
    public function data4() {
        return $this->state([
            'id' => '4',
            'name' => 'Tempat Parkir',
        ]);
    }
    public function data5() {
        return $this->state([
            'id' => '5',
            'name' => 'Taman',
        ]);
    }
    
}
