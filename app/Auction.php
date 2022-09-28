<?php

namespace App;
use Auth;
use App\User;
use App\Bid;
use App\Extra;
use App\Category;
use App\Location;
use App\Place;
use App\Vehicle_list;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;
use Carbon\Carbon;
use App\Service;
use App\ServicePrice;
use App\Coupon;
use App\VehicleType;
use App\Country;

class Auction extends Model
{
    use Sortable;

    protected $fillable = [
        'auction_id',
        'date',
        'time',
        'from_time',
        'to_time',
        'from_city',
        'to_city',
        'from_location',
        'to_location',
        'title',
        'description',
        'pickup_from_location',
        'starting_bid',
        'passengers',
        'seats',
        'min_seat',
        'child_seats',
        'baby_seats',
        'extras',
        'service_code',
        'vehicle_size',
        // new fiels
        'key',
        'service_id',
        'full_name',
        'email',
        'phone',
        'nationality',
        'language',
        'type',
        'arrival_time',
        'want_to_arrive',
        'pickup_time',
        'arrival_airline',
        'flight_number',
        'more_information',
        'return_more_information',
        'ip',
        'service_price_id',
        'order_total',
        'catering',
        'fare',
        'extra_payment',
        'coupon_id',
        'discount',
        'paid_amount',
        'paid_date',
        'payment_method',
        'payment_status',
        'adults',
        'infants',
        'babies',
        'country_id',
        'region_id',
        'more_information_2',
        'return_more_information_2',
        'checked_by'
    ];

    public $sortable = ['end_date', 'from_location', 'to_location', 'from_city', 'to_city', 'category_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function servicePrice()
    {
        return $this->belongsTo(ServicePrice::class, 'service_price_id');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    // public function extras()
    // {
    //     return $this->belongsToMany(Extra::class);
    // }

    public function extras()
    {
        return $this->hasMany(Extra::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // By user Country
    public function scopeUserLocation($query)
    {
        if (Auth::user()->country_id == 1) 
        {
            return $query->where('country_id', Auth::user()->country_id);
        }else {
            return $query->where('region_id', Auth::user()->region_id);
        }
    }
    
    // By user region
    public function scopeUserRegion($query)
    {
        return $query->where('region_id', Auth::user()->region_id);
    }

    // Location
    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function fromcity()
    {
        return $this->belongsTo(Location::class, 'from_city');
    }

    public function tocity()
    {
        return $this->belongsTo(Location::class, 'to_city');
    }

    public function fromlocation()
    {
        return $this->belongsTo(Place::class, 'from_location');
    }

    public function tolocation()
    {
        return $this->belongsTo(Place::class, 'to_location');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle_list::class, 'vehicle_size');
    }

    public function vehicleType()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type');
    }

    public function pickupfromlocation()
    {
        return $this->belongsTo(Place::class, 'pickup_from_location');
    }

    // Scopes
    public function scopeOpen($query)
    {
        return $query->where('status', 'Open');
    }

    public function scopeClosed($query)
    {
        return $query->where('status', 'Closed');
    }

    public function scopeActive($query)
    {
        return $query->where('deleted', 0)->whereDate('date', '>', Carbon::yesterday())->orWhere('start_date','>', Carbon::yesterday());
    }

    public function scopeInactive($query)
    {
        return $query->where('deleted', 0)->whereDate('date', '<', Carbon::today()->addHours(3));
    }

    public function scopeFrom($query)
    {
        return $query->whereNotNull('from_city');
    }

    public function scopeTo($query, $to)
    {
        return $query->where('to', 'LIKE', "%$to%");
    }

    // Categories
    public function scopePrivate($query)
    {
        return $query->where('category_id', 1);
    }

    public function scopeSharing($query)
    {
        return $query->where('category_id', 2);
    }

    public function scopeContract($query)
    {
        return $query->where('category_id', 3);
    }

    public function scopeTours($query)
    {
        return $query->where('category_id', 3);
    }

    public function scopeEmptyLegs($query)
    {
        return $query->where('category_id', 4);
    }

    public function scopeBooking($query)
    {
        return $query->where('type', 'booking');
    }

    public function scopeAuction($query)
    {
        return $query->where('type', 'auction');
    }

    public function scopeAllAuctions($query)
    {
        return $query->where('category_id', '!=', 7);
    }

    public function scopeTourist($query)
    {
        return $query->where('category_id', 8);
    }

    public function timeLeft()
    {
        return $this->date->diffInHours($this->created_at);
    }

}
