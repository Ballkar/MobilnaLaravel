<?php


namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class WorkAddUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'start' => 'required|date',
            'stop' => 'required|date',
            'customer_id' => 'required|exists:customers,id',
            'label_id' => 'nullable|exists:calendar_labels,id',
        ];
    }
}
