<?php

namespace App\Http\Controllers\Api\v1\Admin\Message\Plans;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Admin\RemindPlanSchemaRequest;
use App\Http\Resources\Message\Plans\RemindPlanSchema as RemindPlanSchemaResource;
use App\Http\Resources\Message\Plans\RemindPlanSchemaCollection;
use App\Models\Message\Plans\RemindPlanSchema;
use App\Http\Controllers\Controller;

class RemindPlanSchemaController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(RemindPlanSchema::class, 'schema');
    }

    public function index()
    {
        $schemas = RemindPlanSchema::paginate(5);
        return $this->sendResponse(new RemindPlanSchemaCollection($schemas), 'Schemas for remind plan returned');
    }

    public function update(RemindPlanSchemaRequest $request, RemindPlanSchema $schema)
    {
        $schema->update($request->validated());
        return $this->sendResponse(new RemindPlanSchemaResource($schema), 'Schema updated');
    }

    public function store(RemindPlanSchemaRequest $request)
    {
        $schema = RemindPlanSchema::create($request->validated());
        return $this->sendResponse(new RemindPlanSchemaResource($schema), 'Schema created');
    }
}
