<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Factories\UserFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     //NOTE: Here is the User of Factory Pattern 
     $user =UserFactory::new()->create([
            'email'=>'admin@admin.com',
            'password'=>'admin1234'
        ]);

        $user->assignRole('admin');

    }
}
