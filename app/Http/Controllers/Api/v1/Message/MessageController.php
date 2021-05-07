<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessageInitRequest;
use App\Http\Resources\Message\Message as MessageResource;
use App\Http\Resources\Message\MessageCollection;
use App\Models\Announcement\Customer;
use App\Models\Message\Message;
use App\Services\MessageService;
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
        $query = $request->get('query');
        if(isset($query)) {
            $messages = Message::where('owner_id', Auth::id())
                ->where(function($q) use ($query) {
                    $q->where('name', 'like', '%' . $query . '%')
                    ->orWhereHas('customer', function ($messages) use ( $query ) {
                        $messages->where('name', 'like', '%' . $query . '%')
                            ->orWhere('surname', 'like', '%' . $query . '%')
                            ->orWhere('phone', 'like', '%' . $query . '%');
                    })
                    ->orderBy('created_at', 'DESC');
                })
                ->paginate($limit);
        } else {
            $messages = Message::where('owner_id', '=', Auth::id())->orderBy('created_at', 'DESC')->paginate($limit);
        }

        return $this->sendResponse(new MessageCollection($messages), 'All messages returned');
    }

    /**
     * @param MessageInitRequest $request
     * @return JsonResponse
     */
    public function initMessage(MessageInitRequest $request)
    {
        $customer = Customer::find($request->get('customer_id'));
        $user = $request->user('api');
        $text = $request->get('text');

        $name = 'Jednorazowa wiadomość';
        $to = $customer->phone;
        $from = $user->name;

        if(!MessageService::checkUserIsAbleToSendSMS($user, $text)) {
            return $this->sendError('Brak wystarczających środków na koncie', 402);
        }

        try {
            $messageService = new MessageService();
            $messageService->send($text, $from, $to);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }

        $messageSended = Message::create([
            'owner_id' => $user->id,
            'customer_id' => $customer->id,
            'name' => $name,
            'text' => $text,
        ]);
        $user->wallet->subtract(MessageService::$messageCost);
        return $this->sendResponse(new MessageResource($messageSended), 'Message sended', 201);
    }

    /**
     * @param Message $history
     * @return JsonResponse
     */
    public function show(Message $history)
    {
        return $this->sendResponse(new MessageResource($history), 'Message returned');
    }
}
