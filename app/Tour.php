<?php

namespace App;
use App\User;
use App\Bid;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use App\Country;
use App\Location;
use App\TourImages;
class Tour extends Model
{
    use Sortable;

    protected $fillable = [
        'location_id', 
        'attraction_id',
        'image', 
        'image_alt',
        'title', 
        'slug', 
        'user_id', 
        'short_description',
        'description',
        'status',
        'url'
    ];

    public $sortable = ['end_date', 'location'];

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
        return $this->belongsTo(Location::class, 'location_id');
    }
    
    public function depLocation()
    {
        return $this->belongsTo(Location::class, 'departure_location');
    }

    public function attraction()
    {
        return $this->belongsTo(Attraction::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function images()
    {
        return $this->hasMany(TourImages::class, 'tour_id');
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 'Open');
    }

}
