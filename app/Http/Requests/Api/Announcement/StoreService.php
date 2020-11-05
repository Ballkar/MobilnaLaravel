<?php

namespace App\Http\Requests\Api\Api\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class StoreService extends FormRequest
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
            'group_id' => 'required|exists:announcements,id',
            'name' => 'required|min:3|max:200',
            'price' => 'required|numeric',
            'time_hours' => 'required|numeric',
            'time_minutes' => 'required|numeric',
        ];
    }
}
