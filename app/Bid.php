<?php

namespace App;

use App\Auction;

use App\Tour;

use App\User;

use Illuminate\Database\Eloquent\Model;

use Kyslik\ColumnSortable\Sortable;

class Bid extends Model
{
    use Sortable;

    protected $fillable = ['bid', 'auction_id', 'user_id'];

    public $sortable = ['bid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function auction()
    {
        return $this->belongsTo(Auction::class);
    }

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }

    public function scopeWon($query)
    {
        return $query->where('won', 1);
    }

    public function scopeLost($query)
    {
        return $query->where('won', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('canceled', 0);
    }
}
