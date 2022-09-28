<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Whale extends Model
{
    protected $fillable = ['title', 'name', 'slug', 'description', 'location', 'price'];
}
