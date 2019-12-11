<?php

namespace App\Http\Requests\Api\Announcement;

use App\Http\Controllers\Constants\AnnouncementTypes;
use Illuminate\Foundation\Http\FormRequest;

class StoreAnnouncementRequest extends FormRequest
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
            'name' => 'required|min:3|max:200',
            'description' => 'required|min:3|max:200',
            'is_mobile' => 'boolean',
            'mobile_price' => 'numeric',
            'mobile_distance' => 'numeric',
            'type_id' => 'required|in:'.implode(',', AnnouncementTypes::returnAll()),

            'city_id' => 'required|exists:cities,id',
            'road' => 'string|min:4',
            'house_number' => 'string|min:1',
            'flat_number' => 'string|min:1',
        ];
    }
}
