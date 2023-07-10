<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Address;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{

    /**
     * helper for function getNimOrNik
     * 
     */
    function randomNumber($length): string{
        $number = range(9, 100);
        shuffle($number);
        return substr(implode('', $number), 0, $length);
    }

    /**
     * create nim or nik random
     * 
     */
    public function  getNimOrNik(): string {
        return (rand(1,100) % 2 === 0) ? $this->randomNumber(10) : $this->randomNumber(16);
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nim_or_nik' => $this->getNimOrNik(),
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'profile_picture' => fake()->imageUrl(),
            'password' => 'password',
            'address_id' => Address::factory(),
            'phone' => fake()->phoneNumber(),
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
}
