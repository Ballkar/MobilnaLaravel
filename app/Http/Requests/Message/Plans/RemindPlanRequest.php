<?php

namespace App\Http\Requests\Message\Plans;

use App\Http\Controllers\Constants\PlanTypes;
use App\Models\Message\Plans\PlanSchema;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

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

    protected function prepareForValidation()
    {
        $schema = PlanSchema::find($this->get('schema_id'));
        $this->merge([
            'schema' => $schema
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'schema_id' => 'required|exists:message_plans_schemas,id',
            'schema.type' => Rule::in(PlanTypes::REMIND),
            'active' => 'boolean',
        ];
    }
}
