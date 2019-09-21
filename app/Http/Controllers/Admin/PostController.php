<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog\Category;
use App\Models\Blog\Post;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\View\View;

class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
        return view('admin.blog.post.index', compact("posts"));
    }

    /**
     *
     * @return Factory|View
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.blog.post.create', compact("categories"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'title' => ['required', 'min:5'],
            'text' => ['required', 'min:25'],
            'category_id' => ['required'],
        ])->validated();

        $post = Post::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'category_id' => $data['category_id'],
            'user_id' => auth()->id()
        ]);

        return redirect('/admin/blog/post/'.$post->id );
    }

    /**
     * @param Post $post
     * @return Factory|View
     */
    public function show(Post $post)
    {
        $category =  $post->category;
        return view('admin.blog.post.show', compact('post', 'category'));
    }

    /**
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        return view('admin.blog.post.edit', compact('post', 'categories'));
    }

    /**
     * @param Request $request
     * @param Post $post
     */
    public function update(Request $request, Post $post)
    {

    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
