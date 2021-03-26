<?php

namespace App\Http\Requests\Message\Plans;

use App\Models\Message\Plans\PlanSchema;
use Illuminate\Foundation\Http\FormRequest;

class RemindPlanPreviewRequest extends FormRequest
{

    protected function prepareForValidation()
    {
        $schema = PlanSchema::find($this->get('schema_id'));
        $this->merge([
            'schema' => $schema
        ]);
    }

    public function rules()
    {
        return [
            'customer_id' => 'exists:customers,id',
            'schema_id' => 'exists:message_plans_schemas,id',
        ];
    }
}
