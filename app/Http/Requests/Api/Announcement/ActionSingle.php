<?php

namespace App\Http\Requests\Api\Announcement;

use App\Http\Controllers\Constants\WeekDays;
use Illuminate\Foundation\Http\FormRequest;

class ActionSingle extends FormRequest
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
            'announcement_id' => 'required|exists:announcements,id',
            'type_id' => 'required|exists:calendar_action_types,id',
            'customer_id' => 'required|exists:customers,id',
            'start_date' => 'required|date_format:Y-m-d H:i:s',
            'end_date' => 'required|date_format:Y-m-d H:i:s',

            'phone' => '',
            'is_mobile' => '',
            'street' => '',
            'house_number' => '',
            'flat_number' => '',
        ];
    }
}
