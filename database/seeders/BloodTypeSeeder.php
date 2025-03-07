<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BloodType;

class BloodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        BloodType::create([
            'name' => 'A+',
        ]);
        BloodType::create([
            'name' => 'A-',
        ]);
        BloodType::create([
            'name' => 'B+',
        ]);
        BloodType::create([
            'name' => 'B-',
        ]);
        BloodType::create([
            'name' => 'AB+',
        ]);
        BloodType::create([
            'name' => 'AB-',
        ]);
        BloodType::create([
            'name' => 'O+',
        ]);
        BloodType::create([
            'name' => 'O-',
        ]);

    }
}
