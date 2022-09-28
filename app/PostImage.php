<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class PostImage extends Model
{
    protected $fillable = ['post_id', 'file_name', 'type', 'size'];

    public function post()
    {
        return $this->belongsTo(Post::class);
    }
}
