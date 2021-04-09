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
            'works.*.start' => 'required|date|before:works.*.stop|after:' . date('Y-m-d H:i:s'),
            'works.*.stop' => 'required|date|after:works.*.start',
            'works.*.customer_id' => 'required|exists:customers,id',
            'works.*.worker_id' => 'nullable|exists:workers,id',
        ];
    }
}
