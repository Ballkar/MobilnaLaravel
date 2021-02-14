<?php


namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class GetCalendarWorksRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "start"    => "required|date",
            "stop"    => "required|date",
            'labels_ids' => 'nullable|array',
            'labels_ids.*' => 'exists:calendar_labels,id',
        ];
    }
}
