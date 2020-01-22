<?php

namespace App\Http\Requests\Api\Blog;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|min:5|max:200',
            'text' => 'required|min:30',
            'active' => 'required|boolean',
            'category_id' => 'required|exists:blog_categories,id',
//            'user_id' => 'required|exists:users,id',
        ];
    }
}
