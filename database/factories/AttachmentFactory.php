<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Attachment>
 */
class AttachmentFactory extends Factory
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
            'complaint_id' => '20250116015433001',
            'path_file' => '/storage/attachments/images/HSPvDK2UNrU4gHFKzCv0DLiIL7eOOJ7WIy7CcTCh.png',
            'file_type' => 'png',
            'created_at' => '2025-01-16 01:54:33',
            'updated_at' => '2025-01-16 01:54:33',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' => '2',
            'complaint_id' => '20250116015433001',
            'path_file' => '/storage/attachments/images/ZyWOAcE3izY1k7eebNsUGWmMUgeezWfT72B4ohgF.png',
            'file_type' => 'png',
            'created_at' => '2025-01-16 01:54:33',
            'updated_at' => '2025-01-16 01:54:33',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'complaint_id' => '20250116025234001',
            'path_file' => '/storage/attachments/images/pVZYwu7dYvxfIZFJVHxgmQoLq45pJ0moT237fA7U.png',
            'file_type' => 'png',
            'created_at' => '2025-01-16 02:52:34',
            'updated_at' => '2025-01-16 02:52:34',
        ]);
    }
    public function data4() {
        return $this->state([
            'id' => '4',
            'complaint_id' => '20250116025416001',
            'path_file' => '/storage/attachments/images/75VAvfuEWvd63YUAWUfsZKPsOp5SXsNJ9EB1oJhT.jpg',
            'file_type' => 'jpg',
            'created_at' => '2025-01-16 02:54:16',
            'updated_at' => '2025-01-16 02:54:16',
        ]);
    }
    public function data5() {
        return $this->state([
            'id' => '5',
            'complaint_id' => '20250116033602001',
            'path_file' => '/storage/attachments/pdf/YVqzYDPWs3Hnqdtfyffc767JBTnDyk8pt6FeFXfh.pdf',
            'file_type' => 'pdf',
            'created_at' => '2025-01-16 03:36:03',
            'updated_at' => '2025-01-16 03:36:03',
        ]);
    }
    public function data6() {
        return $this->state([
            'id' => '6',
            'complaint_id' => '20250117103325001',
            'path_file' => '/storage/attachments/pdf/DFsyr7uoy7SRVQTcUKacONWpeNHLtOwALc3e2Uyt.pdf',
            'file_type' => 'pdf',
            'created_at' => '2025-01-17 10:33:26',
            'updated_at' => '2025-01-17 10:33:26',
        ]);
    }
    public function data7() {
        return $this->state([
            'id' => '7',
            'complaint_id' => '20250117103346001',
            'path_file' => '/storage/attachments/pdf/q8wxsK08QHAVSnrs7WYEPVEooSurJH5ZsYuZjGKO.pdf',
            'file_type' => 'pdf',
            'created_at' => '2025-01-17 10:33:46',
            'updated_at' => '2025-01-17 10:33:46',
        ]);
    }
    public function data8() {
        return $this->state([
            'id' => '8',
            'complaint_id' => '20250117103422001',
            'path_file' => '/storage/attachments/images/6T3BeFnpEO2tyvy00tMsQz7n0shFZbCLYXdZbCMK.jpg',
            'file_type' => 'jpg',
            'created_at' => '2025-01-17 10:34:22',
            'updated_at' => '2025-01-17 10:34:22',
        ]);
    }
    public function data9() {
        return $this->state([
            'id' => '9',
            'complaint_id' => '20250117140040001',
            'path_file' => '/storage/attachments/pdf/kZtmnHYTA1KezVVbPxXGeiipHgiOkrzAMScavaz1.pdf',
            'file_type' => 'pdf',
            'created_at' => '2025-01-17 14:00:41',
            'updated_at' => '2025-01-17 14:00:41',
        ]);
    }
    public function data10() {
        return $this->state([
            'id' => '10',
            'complaint_id' => '20250117143933001',
            'path_file' => '/storage/attachments/images/GMpaAu5iKAURn4lKfo1sfQp8AMyFcm7hV671AqQS.png',
            'file_type' => 'png',
            'created_at' => '2025-01-17 14:39:34',
            'updated_at' => '2025-01-17 14:39:34',
        ]);
    }
    public function data11() {
        return $this->state([
            'id' => '11',
            'complaint_id' => '20250118091331001',
            'path_file' => '/storage/attachments/pdf/ZXdm2CihZBTX01E44Th8VoB4X7JTniisgrVuvBXE.pdf',
            'file_type' => 'pdf',
            'created_at' => '2025-01-18 09:13:31',
            'updated_at' => '2025-01-18 09:13:31',
        ]);
    }
    public function data12() {
        return $this->state([
            'id' => '12',
            'complaint_id' => '20250121093747001',
            'path_file' => '/storage/attachments/images/CKN1MVRIVV9cqI25LlNQ8vZTiLrZjYRPiIuVDpRb.jpg',
            'file_type' => 'jpg',
            'created_at' => '2025-01-21 09:37:48',
            'updated_at' => '2025-01-21 09:37:48',
        ]);
    }
}
