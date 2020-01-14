<?php

namespace App\Models\Blog;

use App\Models\BaseImage;
use Illuminate\Support\Facades\Storage;

class Image extends BaseImage
{
    protected $guarded = [];
    protected $appends = ['path'];
    protected $table = 'blog_posts_images';

    public function getPathAttribute()
    {
        return Storage::disk('public')->url('posts/' . $this->post_id . '/' . $this->name);
    }

    /**
     * Get the Announcement that owns the image.
     */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

    /**
     * Get the services for the announcement.
     */
    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
