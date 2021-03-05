<?php

namespace App\Http\Requests\Message\Plans;

use Illuminate\Foundation\Http\FormRequest;

class RemindPlanRequest extends FormRequest
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
            'body' => 'required|array',
            'body.*.text' => 'required_without:body.*.variable',
            'body.*.variable' => 'required_without:body.*.text',
            'body.*.variable.name' => 'required_with:body.*.variable',
            'body.*.variable.model' => 'required_with:body.*.variable',
            'clear_diacritics' => 'required',

            'active' => 'boolean',
            'hour' => 'required|int',
            'minute' => 'required|int',
            'time_type' => 'required|int',
        ];
    }
}
