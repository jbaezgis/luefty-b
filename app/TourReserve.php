<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Tour;
class TourReserve extends Model
{
    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
