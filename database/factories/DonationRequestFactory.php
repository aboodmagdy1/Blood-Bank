<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DonationRequest>
 */
class DonationRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'patient_name' => fake()->name(),
            'patient_phone' => fake()->phoneNumber(),
            'city_id' => fake()->numberBetween(1, 16),
            'hospital_name' => fake()->name(),
            'hospital_address' => fake()->address(),
            'blood_type_id' => fake()->numberBetween(1, 8),
            'patient_age' => fake()->numberBetween(1, 100),
            'details' => fake()->text(),
            'bags_num' => fake()->numberBetween(1, 10),
            'latitude' => 30.969056,
            'longitude' =>31.325987,           
             'client_id' => fake()->numberBetween(1, 10),

        ];
    }
}
