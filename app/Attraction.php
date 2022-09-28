<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Country;
use App\Location;
use App\Tour;

class Attraction extends Model
{
    protected $fillable = [
        'user_id',
        'country_id',
        'location_id',
        'image',
        'image_alt',
        'slug',
        'title',
        'short_description',
        'description',
        'published'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function tours()
    {
        return $this->hasMany(Tour::class);
    }
}
