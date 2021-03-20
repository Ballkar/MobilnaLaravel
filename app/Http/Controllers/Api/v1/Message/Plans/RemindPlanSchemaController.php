<?php

namespace App\Http\Controllers\Api\v1\Message\Plans;

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
}
