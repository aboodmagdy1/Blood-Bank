<?php

namespace Database\Seeders;

use App\Models\Setting;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        // TODO:refactor this to factory 
        Setting::create([
            'notification_setting_text' => 'notification_setting_text content',
            'about_app' => 'about_app_text content',
            'phone' => 'phone content',
            'email' => 'email content',
            'fb_link' => 'fb_link content',
            'tw_link' => 'tw_link content',
            'insta_link' => 'insta_link content',
            'youtube_link' => 'youtube_link content',
            'watts_link' => 'whats_link content',

        ]);

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            PostSeeder::class,
            BloodTypeSeeder::class,
            CitySeeder::class,
            ClientSeeder::class,
            DonationRequestSeeder::class,

        ]);
    }
}
