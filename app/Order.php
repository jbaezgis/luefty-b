<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Whale;

class Order extends Model
{
    protected $fillable = ['whale_id', 'name', 'email', 'phone', 'persons', 'kids' , 'adult', 'date', 'hotel', 'hotel_location' , 'location', 'room_number', 'total'];

    public function whale()
    {
        return $this->belongsTo(Whale::class);
    }
}
