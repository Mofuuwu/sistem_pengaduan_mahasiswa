<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Logs>
 */
class LogsFactory extends Factory
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
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250116015433001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-16 01:54:33',
            'updated_at' => '2025-01-16 01:54:33',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' =>'2',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250116025234001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-16 02:52:34',
            'updated_at' => '2025-01-16 02:52:34',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250116025416001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-16 02:54:16',
            'updated_at' => '2025-01-16 02:54:16',
        ]);
    }
    public function data4() {
        return $this->state([
            'id' => '4',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250116033602001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-16 03:36:02',
            'updated_at' => '2025-01-16 03:36:02',
        ]);
    }
    public function data5() {
        return $this->state([
            'id' => '5',
            'name' => 'diterima',
            'description' => null,
            'complaint_id' => '20250116015433001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-17 09:51:20',
            'updated_at' => '2025-01-17 09:51:20',
        ]);
    }
    public function data6() {
        return $this->state([
            'id' => '6',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250117103325001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-17 10:33:25',
            'updated_at' => '2025-01-17 10:33:25',
        ]);
    }
    public function data7() {
        return $this->state([
            'id' => '7',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250117103346001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-17 10:33:46',
            'updated_at' => '2025-01-17 10:33:46',
        ]);
    }
    public function data8() {
        return $this->state([
            'id' => '8',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250117103422001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-17 10:34:22',
            'updated_at' => '2025-01-17 10:34:22',
        ]);
    }
    public function data9() {
        return $this->state([
            'id' => '9',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250117140040001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-17 14:00:40',
            'updated_at' => '2025-01-17 14:00:40',
        ]);
    }
    public function data10() {
        return $this->state([
            'id' => '10',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250117143933001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-17 14:39:33',
            'updated_at' => '2025-01-17 14:39:33',
        ]);
    }
    public function data11() {
        return $this->state([
            'id' => '11',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250118091331001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-18 09:13:31',
            'updated_at' => '2025-01-18 09:13:31',
        ]);
    }
    public function data12() {
        return $this->state([
            'id' => '12',
            'name' => 'dikirim',
            'description' => null,
            'complaint_id' => '20250121093747001',
            'path_file' => null,
            'file_type' => null,
            'created_at' => '2025-01-21 09:37:47',
            'updated_at' => '2025-01-21 09:37:47',
        ]);
    }
}
