<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
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
            'name' => 'Fasilitas Rusak',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' => '2',
            'name' => 'Kebersihan Lingkungan',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'name' => 'Fasilitas Tidak Memadai',
        ]);
    }
    public function data4() {
        return $this->state([
            'id' => '4',
            'name' => 'Tindak Kekerasan/Bullying',
        ]);
    }
    public function data5() {
        return $this->state([
            'id' => '5',
            'name' => 'Lainnya',
        ]);
    }
}
