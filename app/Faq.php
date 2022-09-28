<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    protected $fillable = ['en_title', 'es_title', 'en_text', 'es_text'];
}
