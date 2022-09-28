<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\Type;

class Booking extends Model
{
    protected $fillable = [
        'code',
        'key',
        'from',
        'to',
        'name',
        'email',
        'phone',
        'date',
        'time',
        'airline',
        'flight_number',
        'passengers',
        'type',
    ];

    public function typename()
    {
        return $this->belongsTo(Type::class, 'type');
    }

    // Location
    public function fromlocation()
    {
        return $this->belongsTo(Location::class, 'from');
    }

    public function tolocation()
    {
        return $this->belongsTo(Location::class, 'to');
    }

    public function scopeFrom($query)
    {
        return $query->whereNotNull('from');
    }

    public function scopeTo($query)
    {
        return $query->whereNotNull('to');
    }

    // Scopes
    // public function scopeOpen($query)
    // {
    //     return $query->where('status', 'Open');
    // }

    // public function scopeActive($query)
    // {
    //     return $query->where('deleted', 0)->whereDate('date', '>', Carbon::today());
    // }

    // public function scopeInactive($query)
    // {
    //     return $query->where('status', 'Inactive')->whereDate('date', '<', Carbon::today());
    // }

}
