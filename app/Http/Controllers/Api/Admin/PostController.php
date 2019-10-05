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
        $posts = Post::where('active', '1')->latest()->get();
        return view('admin.blog.post.index', compact("posts"));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        // $data = $this->validator($request);

        $data = $request->all();
        $post = Post::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'category_id' => $data['category_id'],
            'active' => '1',
            'user_id' => auth()->id()
        ]);

        return $post;
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
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Post $post)
    {
        $data = $this->validator($request);
        $post->update($data);
        $post->save();

        return redirect('admin/blog/post/'.$post->id);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Post $post)
    {
        $post->active = '0';
        $post->save();

        return redirect()->back();
    }

    public function validator(Request $request)
    {
        return $this->validate($request, [
            'title' => ['required', 'min:5'],
            'text' => ['required', 'min:25'],
            'category_id' => ['required'],
        ])->validated();
    }
}
