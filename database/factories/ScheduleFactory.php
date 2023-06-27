<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class ScheduleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
        return [
            'tanggal' => fake()->date(),
            'waktu' => fake()->time(),
            'kuota' => rand(30,40),
            'terisi' => rand(0,40),
            'category' => (rand(1,10) % 2 == 0) ? 'tpa' : 'tps',
            'status' => (bool) rand(0,1)
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        // return $this->state(fn (array $attributes) => [
        //     'email_verified_at' => null,
        // ]);
    }
}
