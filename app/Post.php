<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Location;
use App\User;
use App\PostImage;

class Post extends Model
{
    protected $fillable = ['user_id', 'location_id', 'slug', 'title', 'img', 'short_description', 'description', 'published'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function locationid()
    {
        return $this->belongsTo(Location::class, 'location_id');
    }

    public function images()
    {
        return $this->hasMany(PostImage::class, 'post_id');
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('published', 1);
    }
}
