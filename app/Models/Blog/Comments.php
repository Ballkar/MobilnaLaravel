<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model
{
    protected $table = 'blog_comments';
    protected $guarded = [];
}
