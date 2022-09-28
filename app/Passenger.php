<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Auction;

class Passenger extends Model
{
    protected $fillable = [
        'auction_id',
        'first_name',
        'last_name',
        'nationality',
        'type'
    ];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
