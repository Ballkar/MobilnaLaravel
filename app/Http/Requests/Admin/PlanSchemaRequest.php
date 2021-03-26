<?php

namespace App\Http\Requests\Admin;

use App\Http\Controllers\Constants\PlanTypes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PlanSchemaRequest extends FormRequest
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
            'type' => ['required', Rule::in(PlanTypes::returnAll())],
            'body' => 'required|array',
            'body.*.text' => 'required_without:body.*.variable',
            'body.*.variable' => 'required_without:body.*.text',
            'body.*.variable.name' => 'required_with:body.*.variable',
            'body.*.variable.model' => 'required_with:body.*.variable',
        ];
    }
}
