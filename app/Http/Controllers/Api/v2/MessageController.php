<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Message\MessageInitRequest;
use App\Http\Resources\Message\Message as MessageResource;
use App\Http\Resources\Message\MessageCollection;
use App\Models\Message\Message;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    use ApiCommunication;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $messages = Message::paginate($limit);

        return $this->sendResponse(new MessageCollection($messages), 'All messages returned');
    }

    /**
     * @param MessageInitRequest $request
     * @return JsonResponse
     */
    public function store(MessageInitRequest $request)
    {
        $message = Message::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
        ]));
        return $this->sendResponse(new MessageResource($message), 'Message Added', 201);
    }

    /**
     * @param Message $message
     * @return JsonResponse
     */
    public function show(Message $message)
    {
        return $this->sendResponse(new MessageResource($message), 'Message returned');
    }

    // /**
    //  * @param CustomerRequest $request
    //  * @param Message $message
    //  * @return JsonResponse
    //  */
    // public function update(Request $request, Message $message)
    // {
    //     $message->update($request->validated());
    //     return $this->sendResponse(new MessageResource($message), 'Message updated');
    // }

    // /**
    //  * @param Message $message
    //  * @return JsonResponse
    //  * @throws Exception
    //  */
    // public function destroy(Message $message)
    // {
    //     $message->delete();
    //     return $this->sendResponse(null, 'Message deleted', 204);
    // }
}
