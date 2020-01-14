<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\ApiCommunication;
use App\Models\Blog\Image as PostImage;
use App\Models\Blog\Post;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class PostImagesController extends Controller
{
    use ApiCommunication;


    public function index(Post $post)
    {
        $images = $post->images;
        return $this->sendResponse($images, 'Images returned');
    }

    public function show(Request $request, Post $post, PostImage $image)
    {
        return $this->sendResponse($image, 'return images', 201);
    }
}
