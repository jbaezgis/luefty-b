<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Auction;

class Category extends Model
{
    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }

    public function scopePrivate()
    {
        return $this->where('name', 'Private');
    }
}
