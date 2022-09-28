<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $fillable = [
        'image',
        'code',
        'en_name',
        'es_name',
        'slug',
        'description',
    ];
}
