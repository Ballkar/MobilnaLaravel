<?php


namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class LabelMassUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "labels"    => "required|array",
            'labels.*.name' => "required|string",
            'labels.*.color' => "required|string",
        ];
    }
}
