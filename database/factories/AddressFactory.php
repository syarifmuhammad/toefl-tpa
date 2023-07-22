<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 * 
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
            'user_id' =>  fake()->unique()->numberBetween(1, User::count()),
            'street' => fake()->streetAddress(),
            'village' => 'ketintang',
            'sub_district' => fake()->streetSuffix(),
            'district' => fake()->city(),
            'province' => fake()->country(),
            'postal_code' => fake()->postCode()        
        ];
    }
}
