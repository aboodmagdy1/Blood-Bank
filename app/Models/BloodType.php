<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{

    protected $table = 'blood_types';
    public $timestamps = true;
    protected $fillable = array('name');

    public function clients()
    {
        return $this->morphToMany('App\Models\Client', 'clientable');
    }

    public function donationRequests()
    {
        return $this->hasMany('App\Models\DonationRequest');
    }

    public function bloodTypeClients()
    {
        return $this->belongsToMany('App\Models\Client');
    }


    public function delete()
    {
        $this->clients()->update(['blood_type_id' => null]);
        $this->donationRequests()->delete();
        return parent::delete();
    }
}
