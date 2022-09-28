<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Service;
use App\PriceOption;
use App\VehicleType;

class ServicePrice extends Model
{
    protected $fillable = [
        'service_id',
        'vehicle_type',
        'price_option_id',
        'oneway_price',
        'roudtrip_price',
        'starting_bid'
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    public function priceOption()
    {
        return $this->belongsTo(PriceOption::class, 'price_option_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(VehicleType::class, 'vehicle_type');
    }
}
