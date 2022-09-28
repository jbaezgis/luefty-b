<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Country;
use App\Location;

class Region extends Model
{
    protected $fillable = [
        'country_id',
        'image',
        'name',
        'slug',
        'description',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function location()
    {
        return $this->hasMany(Location::class);
    }
}
