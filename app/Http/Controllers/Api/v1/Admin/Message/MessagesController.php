<?php

namespace App\Http\Controllers\Api\v1\Admin\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MessagesListRequest;
use App\Http\Resources\Message\MessageCollection;
use App\Http\Resources\User\User as UserResource;
use App\Models\Message\Message;
use App\Models\User\User;

class MessagesController extends Controller
{
    use ApiCommunication;

    public function index(MessagesListRequest $request)
    {
        $messages = Message::paginate($request->limit);

        return $this->sendResponse(new MessageCollection($messages), 'Users returned');
    }

    public function show(User $user)
    {
//        return $this->sendResponse(new UserResource($user), 'User returned');
    }

}
