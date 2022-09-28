<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instruction extends Model
{
    protected $fillable = ['title_en', 'title_es', 'body_en', 'body_es', 'category'];
}
