<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Contracts\Auth\CanResetPassword;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Notifications\Notifiable;

class Client extends Authenticatable implements CanResetPassword
{
    use Notifiable;


    protected $table = 'clients';
    public $timestamps = true;
    protected $fillable = array('phone', 'email', 'name', 'blood_type_id', 'password', 'reset_code', 'last_donation_date', 'd_o_b', 'city_id', 'is_active');
    protected $hidden = ['password', 'api_token'];
    protected $visible = ['phone', 'email', 'name', 'blood_type_id', 'reset_code', 'last_donation_date', 'd_o_b', 'city_id', 'is_active'];

    public function bloodType()
    {
        return $this->belongsTo('App\Models\BloodType');
    }

    public function city()
    {
        return $this->belongsTo('App\Models\City');
    }

    public function posts()
    {
        return $this->morphedByMany('App\Models\Post', 'clientable');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function notifications()
    {
        return $this->morphedByMany('App\Models\Notification', 'clientable');
    }

    public function bloodTypes()
    {
        return $this->morphedByMany('App\Models\BloodType', 'clientable');
    }

    public function governorates()
    {
        return $this->morphedByMany('App\Models\Governorate', 'clientable');
    }

    public function tokens()
    {
        return $this->hasMany('App\Models\Token');
    }

    protected function password(): Attribute
    {
        return Attribute::make(

            set: fn($value) => bcrypt($value)
        );
    }

    public function getFCMTokens()
    {
        return $this->tokens()->pluck('token')->toArray();
    }
    public function routeNotificationForFcm()
    {
        return $this->getFCMTokens();
    }
}
