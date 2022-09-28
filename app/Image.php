<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['model_type', 'model_id', 'file_name'];

    
}
