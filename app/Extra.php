<?php

namespace App;
use App\Auction;

use Illuminate\Database\Eloquent\Model;

class Extra extends Model
{
    protected $fillable = ['name', 'type'];

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

}
