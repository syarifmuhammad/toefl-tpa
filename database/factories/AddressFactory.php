<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'street' => fake()->streetAddress(),
            'village' => 'ketintang',
            'sub_district' => fake()->streetSuffix(),
            'district' => fake()->city(),
            'province' => fake()->country(),
            'postal_code' => fake()->postCode()        
        ];
    }
}
