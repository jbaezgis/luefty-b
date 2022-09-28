<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'user_id',
        'brand',
        'model',
        'type',
        'year',
        'seats',
        'condition',
        'gps_installed',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
