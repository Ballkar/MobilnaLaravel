<?php

namespace App\Http\Requests\Message\Plans;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RemindPlanPreviewRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_id' => 'exists:customers,id',
            'clear_diacritics' => 'required',
            'body' => 'required|array',
            'body.*.text' => 'required_without:body.*.variable',
            'body.*.variable' => 'required_without:body.*.text',
            'body.*.variable.name' => 'required_with:body.*.variable',
            'body.*.variable.model' => 'required_with:body.*.variable',
        ];
    }
}
