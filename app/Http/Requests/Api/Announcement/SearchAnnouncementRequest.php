<?php

namespace App\Http\Requests\Api\Announcement;

use Illuminate\Foundation\Http\FormRequest;

class SearchAnnouncementRequest extends FormRequest
{

    public function rules()
    {
        return [
            'page' => 'required|integer',
            'per_page' => 'integer',
            'city_id' => 'required|exists:cities,id',
            'is_mobile' => '',
            'is_local' => '',
            'service_group_id' => 'exists:announcement_service_groups,id',
        ];
    }
}
