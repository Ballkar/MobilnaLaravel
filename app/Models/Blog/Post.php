<?php

namespace App\Models\Blog;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    protected $table = 'blog_posts';
    protected $appends = ['image'];
    protected $hidden = ['images'];
    protected $guarded = [];

    public function getImageAttribute()
    {
        $imageMain = $this->images->where('main', 1)->first();
        $url = $imageMain ? $imageMain->path : Storage::disk('public')->url('default.jpg');
        return $url;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
}
