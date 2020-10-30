<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Message\MessageSchemaRequest;
use App\Http\Resources\Message\MessageSchemaResource;
use App\Http\Resources\Message\MessageSchemaCollection;
use App\Models\Message\MessageSchema;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageSchemaController extends Controller
{
    use ApiCommunication;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $schemas = MessageSchema::paginate($limit);

        return $this->sendResponse(new MessageSchemaCollection($schemas), 'All message schema returned');
    }

    /**
     * @param MessageSchemaRequest $request
     * @return JsonResponse
     */
    public function store(MessageSchemaRequest $request)
    {
        $schema = MessageSchema::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
        ]));
        return $this->sendResponse(new MessageSchemaResource($schema), 'MessageSchema Added', 201);
    }

    /**
     * @param MessageSchema $schema
     * @return JsonResponse
     */
    public function show(MessageSchema $schema)
    {
        return $this->sendResponse(new MessageSchemaResource($schema), 'MessageSchema returned');
    }

    /**
     * @param MessageSchemaRequest $request
     * @param MessageSchema $schema
     * @return JsonResponse
     */
    public function update(MessageSchemaRequest $request, MessageSchema $schema)
    {
        $schema->update($request->validated());
        return $this->sendResponse(new MessageSchemaResource($schema), 'MessageSchema updated');
    }

    /**
     * @param MessageSchema $schema
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(MessageSchema $schema)
    {
        $schema->delete();
        return $this->sendResponse(null, 'Schema deleted', 204);
    }
}
