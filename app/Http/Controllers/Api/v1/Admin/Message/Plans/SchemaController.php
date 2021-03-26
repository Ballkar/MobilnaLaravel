<?php

namespace App\Http\Controllers\Api\v1\Admin\Message\Plans;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Admin\PlanSchemaRequest;
use App\Http\Resources\Message\Plans\PlanSchema as PlanSchemaResource;
use App\Models\Message\Plans\PlanSchema;
use App\Http\Controllers\Controller;

class SchemaController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(PlanSchema::class, 'schema');
    }

    public function update(PlanSchemaRequest $request, PlanSchema $schema)
    {
        $schema->update($request->validated());
        return $this->sendResponse(new PlanSchemaResource($schema), 'Schema updated');
    }

    public function store(PlanSchemaRequest $request)
    {
        $schema = PlanSchema::create($request->validated());
        return $this->sendResponse(new PlanSchemaResource($schema), 'Schema created');
    }
}
