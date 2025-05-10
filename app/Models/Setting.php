<?php

namespace App\Models;

use Database\Factories\SettingFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;

    protected $table = 'settings';
    public $timestamps = true;
    public $factory = SettingFactory::class;
    protected $fillable = array('notification_setting_text', 'about_app', 'phone', 'email', 'fb_link', 'tw_link', 'insta_link', 'watts_link', 'youtube_link', 'intro');
}
