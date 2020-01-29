<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Blog\StoreCategoryRequest;
use App\Http\Requests\Api\Blog\UpdateCategoryRequest;
use App\Http\Resources\Blog\Category as CategoryResource;
use App\Http\Resources\BaseResourceCollection;
use App\Models\Blog\Category;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use ApiCommunication;
    /**
     * @param StoreCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreCategoryRequest $request)
    {
        $category = Category::create([
            'name' => $request->name
        ]);

        return $this->sendResponse(new BaseResourceCollection($category), 'Category created', 201);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category->update($request->validated());

        return $this->sendResponse(new CategoryResource($category), 'Update category Success!', 200);
    }

    /**
     * @param Category $category
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return $this->sendResponse(null, 'Category deleted', 204);
    }
}
