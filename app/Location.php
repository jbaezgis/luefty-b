<?php

namespace App;

use App\Country;
use App\Region;
use App\Place;
use App\Service;
use App\Attraction;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $fillable = [
        'country_id',
        'region_id',
        'image',
        'name',
        'slug',
        'short_description',
        'description',
        'order',
        'active',
        'is_airport',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function region()
    {
        return $this->belongsTo(Region::class);
    }

    public function places()
    {
        return $this->hasMany(Place::class);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'from');
    }

    public function servicesTo()
    {
        return $this->hasMany(Service::class, 'to');
    }

    public function attractions()
    {
        return $this->hasMany(Attraction::class);
    }
}
