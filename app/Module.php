<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = [
        'name',
        'active',
    ];

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
}
