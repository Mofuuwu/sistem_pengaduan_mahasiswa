<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Support>
 */
class SupportFactory extends Factory
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
            'user_id' => '1',
            'complaint_id' => '20250116033602001',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' => '2',
            'user_id' => '1',
            'complaint_id' => '20250116015433001',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'user_id' => '2',
            'complaint_id' => '20250116025416001',
        ]);
    }
    public function data4() {
        return $this->state([
            'id' => '4',
            'user_id' => '2',
            'complaint_id' => '20250116015433001',
        ]);
    }
    public function data5() {
        return $this->state([
            'id' => '5',
            'user_id' => '2',
            'complaint_id' => '20250117103422001',
        ]);
    }
    public function data6() {
        return $this->state([
            'id' => '6',
            'user_id' => '2',
            'complaint_id' => '20250117103325001',
        ]);
    }
    public function data7() {
        return $this->state([
            'id' => '7',
            'user_id' => '2',
            'complaint_id' => '20250117140040001',
        ]);
    }
    public function data8() {
        return $this->state([
            'id' => '8',
            'user_id' => '2',
            'complaint_id' => '20250117143933001',
        ]);
    }
    public function data9() {
        return $this->state([
            'id' => '9',
            'user_id' => '2',
            'complaint_id' => '20250116033602001',
        ]);
    }
    public function data10() {
        return $this->state([
            'id' => '10',
            'user_id' => '1',
            'complaint_id' => '20250117140040001',
        ]);
    }
}
