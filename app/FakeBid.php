<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Auction;

class FakeBid extends Model
{
    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }
}
