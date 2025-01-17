<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Rules>
 */
class RulesFactory extends Factory
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
    public function r1() {
        return $this->state([
            'description' => 'Pengaduan harus disertai bukti gambar atau dokumen pendukung.',
        ]);
    }
    public function r2() {
        return $this->state([
            'description' => 'Pengaduan tidak mengandung unsur SARA atau fitnah.',
        ]);
    }
}
