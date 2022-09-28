<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;

class Place extends Model
{
    protected $fillable = [
        'location_id',
        'image',
        'name',
        'slug',
        'description',
        'type',
        'latitude',
        'longitude',
        'address',
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
