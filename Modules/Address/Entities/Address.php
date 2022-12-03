<?php

namespace Modules\Address\Entities;

use Modules\Support\State;
use Modules\Support\Country;
use Modules\User\Entities\User;
use Modules\Support\Eloquent\Model;

class Address extends Model
{
    protected $fillable = ['first_name', 'last_name', 'address_1', 'address_2', 'city', 'state', 'zip', 'country'];

    protected $appends = ['full_name', 'state_name', 'country_name'];

    public function customer()
    {
        return $this->belongsTo(User::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getStateNameAttribute()
    {
        return State::name($this->country, $this->state);
    }

    public function getCountryNameAttribute()
    {
        return Country::name($this->country);
    }
}
