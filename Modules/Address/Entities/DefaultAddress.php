<?php

namespace Modules\Address\Entities;

use Illuminate\Database\Eloquent\Model;

class DefaultAddress extends Model
{
    protected $with = ['address'];

    protected $fillable = ['customer_id', 'address_id'];

    public $timestamps = false;

    public function address()
    {
        return $this->belongsTo(Address::class);
    }

    public function getAddress1Attribute()
    {
        return $this->address->address_1;
    }

    public function getAddress2Attribute()
    {
        return $this->address->address_1;
    }

    public function getCityAttribute()
    {
        return $this->address->city;
    }

    public function getStateAttribute()
    {
        return $this->address->state;
    }

    public function getZipAttribute()
    {
        return $this->address->zip;
    }

    public function getCountryAttribute()
    {
        return $this->address->country;
    }
}
