<?php

namespace Database\Factories;

use App\Models\BloodType;
use Illuminate\Database\Eloquent\Factories\Factory;

class BloodTypeFactory extends Factory
{
    protected $model = BloodType::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->randomElement(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-']),
        ];
    }
} 