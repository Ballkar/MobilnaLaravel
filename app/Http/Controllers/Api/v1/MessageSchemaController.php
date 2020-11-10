<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Api\Message\MessageSchemaRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Message\MessageSchemaCollection;
use App\Http\Resources\Message\MessageSchema as MessageSchemaResource;
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
        $query = $request->get('query');
        if(isset($query)) {
            $schemas = MessageSchema::where('name', 'like', '%' . $query . '%')->paginate($limit);
        } else {
            $schemas = MessageSchema::paginate($limit);
        }
        return $this->sendResponse(new MessageSchemaCollection($schemas), 'All message schema returned');
    }

    /**
     * @param MessageSchemaRequest $request
     * @return JsonResponse
     */
    public function store(MessageSchemaRequest $request)
    {
        $messageSchema = MessageSchema::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
        ]));
        return $this->sendResponse(new MessageSchemaResource($messageSchema), 'MessageSchema Added', 201);
    }

    /**
     * @param MessageSchema $messageSchema
     * @return JsonResponse
     */
    public function show(MessageSchema $messageSchema)
    {
        return $this->sendResponse(new MessageSchemaResource($messageSchema), 'MessageSchema returned');
    }

    /**
     * @param MessageSchemaRequest $request
     * @param MessageSchema $messageSchema
     * @return JsonResponse
     */
    public function update(MessageSchemaRequest $request, MessageSchema $messageSchema)
    {
        $messageSchema->update($request->validated());
        return $this->sendResponse(new MessageSchemaResource($messageSchema), 'MessageSchema updated');
    }

    /**
     * @param MessageSchema $messageSchema
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(MessageSchema $messageSchema)
    {
        $messageSchema->delete();
        return $this->sendResponse(null, 'Schema deleted', 204);
    }
}
