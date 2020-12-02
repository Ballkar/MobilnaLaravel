<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessageInitRequest;
use App\Http\Resources\Message\Message as MessageResource;
use App\Http\Resources\Message\MessageCollection;
use App\Models\Announcement\Customer;
use App\Models\Message\Message;
use App\Models\Message\Schema;
use App\Services\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Instasent\SMSCounter\SMSCounter;

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
                    });
                })
                ->paginate($limit);
        } else {
            $messages = Message::where('owner_id', '=', Auth::id())->paginate($limit);
        }

        return $this->sendResponse(new MessageCollection($messages), 'All messages returned');
    }

    /**
     * @param MessageInitRequest $request
     * @return JsonResponse
     */
    public function initMessage(MessageInitRequest $request)
    {
        $schema_id = $request->get('schema_id');
        $text = $request->get('text');
        $customer = Customer::find($request->get('customer_id'));
        $user = $request->user('api');

        if (isset($schema_id)) {
            $schema = Schema::find($schema_id);
            $body = $schema->body;
            $clearDiacritics = $schema->clear_diacritics;
            $name = $schema->name;
            try {
                $messageText = MessageService::createTextFromSchema($body, $clearDiacritics, $customer, $user, null);
            } catch (Exception $e) {
                return $this->sendError($e->getMessage(), 422);
            }
        } else {
            $messageText = $text;
            $name = 'Jednorazowa wiadomość';
        }

        $to = $customer->phone;
        $from = $request->user('api')->name;

        if(!MessageService::checkUserIsAbleToSendSMS($user, $messageText)) {
            return $this->sendError('Brak wystarczających środków na koncie', 402);
        }

        try {
            $messageService = new MessageService();
            $messageService->send($messageText, $from, $to);
        } catch (\Exception $e) {
            return $this->sendError($e->getMessage(), 422);
        }

        $messageSended = Message::create([
            'owner_id' => $user->id,
            'customer_id' => $customer->id,
            'name' => $name,
            'text' => $messageText,
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
