<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = [
        'notification_setting_text',
        'about_app',
        'phone',
        'email',
        'fb_link',
        'tw_link',
        'insta_link',
        'youtube_link',
        'whats_link',
    ];
} 