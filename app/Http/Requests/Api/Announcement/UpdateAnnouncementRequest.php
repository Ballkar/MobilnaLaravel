<?php

namespace App\Http\Requests\Api\Announcement;

use App\Http\Controllers\Constants\AnnouncementTypes;
use Illuminate\Foundation\Http\FormRequest;

class UpdateAnnouncementRequest extends FormRequest
{

    public function rules()
    {
        return [
            'description' => 'required|min:3|max:200',

            'is_active' => 'boolean',
            'is_mobile' => 'required_without:is_local|boolean',
            'is_local' => 'required_without:is_mobile|boolean',

            'mobile_price' => 'required_with:is_mobile|numeric',
            'mobile_distance' => 'required_with:is_mobile|numeric',

            'city_id' => 'required|exists:cities,id',
            'road' => 'required_with:is_local|string|min:4',
            'house_number' => 'required_with:is_local|string|min:1',
            'flat_number' => 'string|min:1',
        ];
    }
}
