<?php

namespace App\Http\Controllers\Api\v1\Message\Plans;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Constants\PlanTypes;
use App\Http\Resources\Message\Plans\PlanSchemaCollection;
use App\Models\Message\Plans\PlanSchema;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PlanSchemaController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(PlanSchema::class, 'schema');
    }

    public function index(Request $request)
    {
        $request->validate(['type' => ['optional', Rule::in(PlanTypes::returnAll())]]);
        if($request->get('type')) {
            $schemas = PlanSchema::where('type', $request->get('type'))->paginate(9999);
        } else {
            $schemas = PlanSchema::paginate(9999);
        }
        return $this->sendResponse(new PlanSchemaCollection($schemas), 'Schemas for plans returned');
    }
}
