<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    protected static ?string $password;

    public function definition(): array
    {
        return [
            'nama' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'alamat' => fake()->address(),
            'rt_rw' => fake()->numberBetween(1, 12) . '/' . fake()->numberBetween(1, 5),
            'no_hp' => fake()->numerify('08##########'),
            'role' => 'warga',
            'poin_saldo' => fake()->numberBetween(0, 500),
            'is_active' => true,
            'remember_token' => Str::random(10),
        ];
    }

    public function admin(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'admin',
            'poin_saldo' => 0,
        ]);
    }

    public function petugas(): static
    {
        return $this->state(fn(array $attributes) => [
            'role' => 'petugas',
            'poin_saldo' => 0,
        ]);
    }
}
