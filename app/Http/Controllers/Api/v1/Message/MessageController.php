<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessageInitRequest;
use App\Http\Resources\Message\Message as MessageResource;
use App\Http\Resources\Message\MessageCollection;
use App\Models\Announcement\Customer;
use App\Models\Message\Message;
use App\Models\Message\MessageSchema;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

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
        $query = $request->get('query');
        if(isset($query)) {
            $messages = Message::where('name', 'like', '%' . $query . '%')
                ->orWhereHas('customer', function ($messages) use ( $query ) {
                    $messages->where('name', 'like', '%' . $query . '%')
                        ->orWhere('surname', 'like', '%' . $query . '%')
                        ->orWhere('phone', 'like', '%' . $query . '%');
                })
                ->paginate($limit);
        } else {
            $messages = Message::paginate($limit);
        }

        return $this->sendResponse(new MessageCollection($messages), 'All messages returned');
    }

    /**
     * @param MessageInitRequest $request
     * @return JsonResponse
     */
    public function store(MessageInitRequest $request)
    {
        $customer_id = $request->get('customer_id');
        $schema_id = $request->get('schema_id');
        $polishChars = $request->get('with_polish_chars') || false;

        $date = $request->get('date');
        $text = $request->get('text');
        $schema = MessageSchema::find($schema_id);

        $messageText = $schema ? $schema->text : $text;
        $to = Customer::find($customer_id)->phone;
        $from = $request->user('api')->name;

        $name = $schema ? $schema->name : 'Jednorazowa wiadomość';

        return $this->sendResponse([Message::smsCount($messageText, $polishChars), $messageText], 'Message sended', 201);

        try {
            Message::smsCount($text, $polishChars);

        } catch (\Exception $e) {
            $this->sendError($e->getMessage(), 422);
        }
//        $controller = new \App\Http\Controllers\MessageController();
//        $controller->send($messageText, $from, $to);

//        $messageSended = Message::create([
//            'owner_id' => $request->user('api')->id,
//            'customer_id' => $customer_id,
//            'name' => $name,
//            'text' => $messageText,
//        ]);
//        return $this->sendResponse(new MessageResource($messageSended), 'Message sended', 201);
    }

    /**
     * @param Message $history
     * @return JsonResponse
     */
    public function show(Message $history)
    {
        return $this->sendResponse(new MessageResource($history), 'Message returned');
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
