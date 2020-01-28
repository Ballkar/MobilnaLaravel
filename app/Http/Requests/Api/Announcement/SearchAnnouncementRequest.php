<?php

namespace App\Http\Requests\Api\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class SearchAnnouncementRequest extends FormRequest
{

    public function rules()
    {
        return [
            'city_id' => 'required|exists:cities,id',
        ];
    }
}
