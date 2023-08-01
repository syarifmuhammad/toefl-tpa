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
            'tanggal' => fake()->dateTime(),
            'kuota' => rand(30,40),
            'questionbank_id' => 1,
            'biaya' => 200000,
            'status' => (bool) rand(0,1)
        ];
    }
}
