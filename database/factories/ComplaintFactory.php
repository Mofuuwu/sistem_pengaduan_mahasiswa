<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Complaint>
 */
class ComplaintFactory extends Factory
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
            'id' => '20250116015433001',
            'user_id' => '1',
            'location_id' => '1',
            'category_id' => '1',
            'description' => 'Fasilitas ruang kelas rusak, beberapa kursi tidak dapat digunakan dan meja patah.',
            'created_at' => '2025-01-16 01:54:33',
            'updated_at' => '2025-01-16 01:54:33',
        ]);
    }

    public function data2() {
        return $this->state([
            'id' => '20250116025234001',
            'user_id' => '1',
            'location_id' => '2',
            'category_id' => '2',
            'description' => 'Kebersihan kampus kurang terjaga, banyak sampah berserakan di area parkir.',
            'created_at' => '2025-01-16 02:52:34',
            'updated_at' => '2025-01-16 02:52:34',
        ]);
    }

    public function data3() {
        return $this->state([
            'id' => '20250116025416001',
            'user_id' => '1',
            'location_id' => '3',
            'category_id' => '3',
            'description' => 'Keamanan kampus terganggu, penerangan jalan menuju asrama sangat minim.',
            'created_at' => '2025-01-16 02:54:16',
            'updated_at' => '2025-01-16 02:54:16',
        ]);
    }

    public function data4() {
        return $this->state([
            'id' => '20250116033602001',
            'user_id' => '2',
            'location_id' => '2',
            'category_id' => '4',
            'description' => 'Layanan pendaftaran mata kuliah sangat lambat, prosesnya membutuhkan waktu yang lama.',
            'created_at' => '2025-01-16 03:36:02',
            'updated_at' => '2025-01-16 03:36:02',
        ]);
    }

    public function data5() {
        return $this->state([
            'id' => '20250117103325001',
            'user_id' => '2',
            'location_id' => '1',
            'category_id' => '5',
            'description' => 'Makanan di kantin sangat tidak enak dan harganya tidak sesuai dengan kualitasnya.',
            'created_at' => '2025-01-17 10:33:25',
            'updated_at' => '2025-01-17 10:33:25',
        ]);
    }

    public function data6() {
        return $this->state([
            'id' => '20250117103346001',
            'user_id' => '2',
            'location_id' => '3',
            'category_id' => '4',
            'description' => 'Pengurusan ijazah sangat lama, sudah menunggu lebih dari 2 bulan.',
            'created_at' => '2025-01-17 10:33:46',
            'updated_at' => '2025-01-17 10:33:46',
        ]);
    }

    public function data7() {
        return $this->state([
            'id' => '20250117103422001',
            'user_id' => '2',
            'location_id' => '2',
            'category_id' => '3',
            'description' => 'Tindak kekerasan di asrama, ada mahasiswa yang dibuli oleh teman sekamarnya.',
            'created_at' => '2025-01-17 10:34:22',
            'updated_at' => '2025-01-17 10:34:22',
        ]);
    }

    public function data8() {
        return $this->state([
            'id' => '20250117140040001',
            'user_id' => '1',
            'location_id' => '1',
            'category_id' => '2',
            'description' => 'Toilet di gedung A sangat kotor, tidak ada petugas yang membersihkan secara rutin.',
            'created_at' => '2025-01-17 14:00:40',
            'updated_at' => '2025-01-17 14:00:40',
        ]);
    }

    public function data9() {
        return $this->state([
            'id' => '20250117143933001',
            'user_id' => '2',
            'location_id' => '3',
            'category_id' => '1',
            'description' => 'Proyektor di ruang seminar sering bermasalah, banyak pengaturan yang tidak berfungsi.',
            'created_at' => '2025-01-17 14:39:33',
            'updated_at' => '2025-01-17 14:39:33',
        ]);
    }

    public function data10() {
        return $this->state([
            'id' => '20250118091331001',
            'user_id' => '2',
            'location_id' => '3',
            'category_id' => '2',
            'description' => 'Ruangan kelas berdebu dan tidak terawat, beberapa kursi dan meja rusak.',
            'created_at' => '2025-01-18 09:13:31',
            'updated_at' => '2025-01-18 09:13:31',
        ]);
    }

    public function data11() {
        return $this->state([
            'id' => '20250121093747001',
            'user_id' => '1',
            'location_id' => '2',
            'category_id' => '3',
            'description' => 'Ada tindak kekerasan yang dilakukan oleh mahasiswa senior terhadap mahasiswa baru.',
            'created_at' => '2025-01-21 09:37:47',
            'updated_at' => '2025-01-21 09:37:47',
        ]);
    }
}
