<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AttractionImage extends Model
{
    protected $fillable = ['attraction_id', 'file_name', 'type', 'size'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
