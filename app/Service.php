<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\Place;
use App\ServicePrice;
use App\Auction;

class Service extends Model
{
    protected $fillable = [
        'from',
        'to',
        'service_type',
        'driving_type',
        'featured'
    ];

    // Locations
    public function fromLocation()
    {
        return $this->belongsTo(Location::class, 'from');
    }

    public function toLocation()
    {
        return $this->belongsTo(Location::class, 'to');
    }

    public function prices()
    {
        return $this->hasMany(ServicePrice::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }
}
