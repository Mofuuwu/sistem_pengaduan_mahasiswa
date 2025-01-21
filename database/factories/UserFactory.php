<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
    public function data1() {
        return $this->state([
            'id' => '1',
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('admin'),
            'role_id' => '1',
        ]);
    }
    public function data2() {
        return $this->state([
            'id' => '2',
            'name' => 'Muhammad Rifqi',
            'email' => 'muhammadrifqi@gmail.com',
            'password' => bcrypt('muhammadrifqi'),
            'role_id' => '3',
        ]);
    }
    public function data3() {
        return $this->state([
            'id' => '3',
            'name' => 'Muhhamad Hasan',
            'email' => 'muhhamadhasan@gmail.com',
            'password' => bcrypt('muhhamadhasan'),
            'role_id' => '3',
        ]);
    }
}
