<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'=> fake()->name(),
            'phone'=>fake()->phoneNumber(),
            'blood_type_id'=>fake()->numberBetween(1,8),
            'city_id'=>fake()->numberBetween(1,16),
            'email'=>fake()->unique()->email(),
            'password'=>bcrypt('123456'),
            'd_o_b'=>fake()->date(),
            'last_donation_date'=>fake()->date(),
            'is_active'=>1,


        ];
    }
}
