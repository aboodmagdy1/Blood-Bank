<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class SettingsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'notification_setting_text' => 'notification_setting_text content',
            'about_app' => 'about_app_text content',
            'phone' => 'phone content',
            'email' => 'email content',
            'fb_link' => 'fb_link content',
            'tw_link' => 'tw_link content',
            'insta_link' => 'insta_link content',
            'youtube_link' => 'youtube_link content',
            'watts_link' => 'whats_link content',

        ];
    }
}
