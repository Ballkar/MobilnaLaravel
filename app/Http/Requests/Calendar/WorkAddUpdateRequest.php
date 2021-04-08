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
            'start' => 'required|date|before:stop|after:' . date('Y-m-d H:i:s'),
            'stop' => 'required|date|after:start',
            'customer_id' => 'required|exists:customers,id',
            'worker_id' => 'nullable|exists:workers,id',
        ];
    }
}
