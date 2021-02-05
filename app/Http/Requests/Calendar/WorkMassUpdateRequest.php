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
            'works.*.start' => 'required|date',
            'works.*.stop' => 'required|date',
            'works.*.customer_id' => 'required|exists:customers,id',
        ];
    }
}
