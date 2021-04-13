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
            'workers_ids' => 'nullable|array',
            'workers_ids.*' => 'nullable|exists:workers,id',
        ];
    }
}
