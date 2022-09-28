<?php

namespace App;
use App\Auction;
use App\Extra;

use Illuminate\Database\Eloquent\Model;

class ExtraProvider extends Model
{
    protected $table = 'extras_providers';

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function extra()
    {
        return $this->belongsTo(Extra::class);
    }

}
