<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Blog\StorePostRequest;
use App\Http\Requests\Api\Blog\UpdatePostRequest;
use App\Http\Resources\Blog\Post as PostResource;
use App\Models\Blog\Post;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\BaseResourceCollection;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ApiCommunication;

    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return $this->sendResponse(new BaseResourceCollection($posts), 'Posts returned');
    }

    public function store(StorePostRequest $request)
    {
        $post = Post::create([
            'title' => $request->title,
            'text' => $request->text,
            'active' => $request->active,
            'category_id' => $request->category_id,
            'user_id' => Auth::id(),
        ]);

        return $this->sendResponse(new PostResource($post), 'Post created', 201);
    }

    /**
     * @param UpdatePostRequest $request
     * @param Post $post
     * @return JsonResponse
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->validated());

        return $this->sendResponse(new PostResource($post), 'Update post Success!', 200);
    }

    /**
     * @param Post $post
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return $this->sendResponse(null, 'Post deleted successfully', 204);
    }
}
