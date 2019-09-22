<?php

namespace App\Http\Controllers\Admin;

use App\Models\Blog\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
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

        $categories = Category::all();
        return view('admin.blog.category.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(), [
            'name' => ['required', 'string']
        ])->validated();

        Category::create([
            'name' => $data['name']
        ]);

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Category $category)
    {
        $posts = $category->posts()->where('active', '1')->latest()->get();

        return view('admin.blog.category.show', compact('category', 'posts'));
    }

    /**
     *
     * @param Request $request
     * @param Category $category
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     *
     * @param Category $category
     */
    public function destroy(Category $category)
    {
        //
    }
}
