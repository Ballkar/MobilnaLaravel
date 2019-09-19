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
        //
    }

    /**
     * @param Category $category
     *
     * @return Factory|View
     */
    public function create(Category $category)
    {

//        die(dump($category->name));
        return view('admin.blog.post.create', compact("category"));
    }

    /**
     * @param Request $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request, Category $category)
    {
        $data = Validator::make($request->all(), [
            'title' => ['required', 'min:5'],
            'text' => ['required', 'min:25']
        ])->validated();

        $post = Post::create([
            'title' => $data['title'],
            'text' => $data['text'],
            'category_id' => $category->id,
            'user_id' => auth()->id()
        ]);
        return redirect('/admin/blog/category/'.$category->id.'/post/'.$post->id );
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return Factory|View
     */
    public function show(Category $category , Post $post)
    {
        return view('admin.blog.post.show', compact('post', 'category'));
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return Factory|View
     */
    public function edit(Category $category , Post $post)
    {
        return view('admin.blog.post.edit');
    }

    /**
     * @param Request $request
     * @param Category $category
     * @param Post $post
     */
    public function update(Request $request, Category $category , Post $post)
    {
        //
    }

    /**
     * @param Category $category
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(Category $category , Post $post)
    {
        $post->delete();
        return redirect()->back();
    }
}
