<?php


namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class WorkMassUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "works"    => "required|array",
            'works.*.id' => 'required|exists:calendar_works,id',
            'works.*.start' => 'required|date|before:stop|after:' . date('Y-m-d H:i:s'),
            'works.*.stop' => 'required|date|after:start|after:' . date('Y-m-d H:i:s'),
            'works.*.customer_id' => 'required|exists:customers,id',
            'works.*.label_id' => 'nullable|exists:calendar_labels,id',
        ];
    }
}
