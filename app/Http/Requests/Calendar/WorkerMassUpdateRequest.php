<?php


namespace App\Http\Requests\Calendar;

use Illuminate\Foundation\Http\FormRequest;

class WorkerMassUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "workers"    => "required|array",
            'workers.*.name' => "required|string",
            'workers.*.color' => "required|string",
        ];
    }
}
