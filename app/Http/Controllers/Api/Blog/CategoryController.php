<?php

namespace App\Http\Controllers\Api\Blog;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\Blog\Category as CategoryResource;
use App\Models\Blog\Category;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $categories = Category::paginate(10);
        return $this->sendResponse(new CategoryResource($categories), 'All categories returned', 200);
    }
    /**
     * @param Category $category
     * @return JsonResponse
     */
    public function show(Category $category)
    {
        return $this->sendResponse(new CategoryResource($category), 'Category returned', 200);
    }
}
