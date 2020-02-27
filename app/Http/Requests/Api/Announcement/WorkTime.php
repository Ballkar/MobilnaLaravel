<?php

namespace App\Http\Requests\Api\Announcement;

use App\Http\Controllers\Constants\WeekDays;
use Illuminate\Foundation\Http\FormRequest;

class WorkTime extends FormRequest
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
            'week_day' => 'required|numeric|in:'.implode(',', WeekDays::returnAll()),
            'start_hour' => 'required|numeric',
            'start_minute' => 'required|numeric',
            'end_hour' => 'required|numeric',
            'end_minute' => 'required|numeric',
        ];
    }
}
