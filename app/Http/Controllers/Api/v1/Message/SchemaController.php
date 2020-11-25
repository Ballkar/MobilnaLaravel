<?php

namespace App\Http\Controllers\Api\v1\Message;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Message\MessagePreviewRequest;
use App\Http\Requests\Message\MessageSchemaRequest;
use App\Models\Announcement\Customer;
use App\Http\Resources\Message\MessageSchemaCollection;
use App\Http\Resources\Message\MessageSchema as MessageSchemaResource;
use App\Models\Message\Schema;
use App\Models\User\User;
use App\Services\MessageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Instasent\SMSCounter\SMSCounter;

class SchemaController extends Controller
{
    use ApiCommunication;

    public function __construct()
    {
        $this->authorizeResource(Schema::class, 'schema');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $query = $request->get('query');
        if(isset($query)) {
            $schemas = Schema::where('owner_id', Auth::id())
                ->where('name', 'like', '%' . $query . '%')
                ->paginate($limit);
        } else {
            $schemas = Schema::where('owner_id', '=', Auth::id())
                ->paginate($limit);
        }
        return $this->sendResponse(new MessageSchemaCollection($schemas), 'All message schema returned');
    }

    /**
     * @param MessageSchemaRequest $request
     * @return JsonResponse
     */
    public function store(MessageSchemaRequest $request)
    {
        $schema = Schema::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
        ]));
        return $this->sendResponse(new MessageSchemaResource($schema), 'Schema Added', 201);
    }

    /**
     * @param Schema $schema
     * @return JsonResponse
     */
    public function show(Schema $schema)
    {
        return $this->sendResponse(new MessageSchemaResource($schema), 'Schema returned');
    }

    /**
     * @param MessageSchemaRequest $request
     * @param Schema $schema
     * @return JsonResponse
     */
    public function update(MessageSchemaRequest $request, Schema $schema)
    {
        $schema->update($request->validated());
        return $this->sendResponse(new MessageSchemaResource($schema), 'Schema updated');
    }

    /**
     * @param Schema $schema
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Schema $schema)
    {
        $schema->delete();
        return $this->sendResponse(null, 'Schema deleted', 204);
    }

    /**
     * @param MessagePreviewRequest $request
     * @return JsonResponse
     */
    public function preview(MessagePreviewRequest $request)
    {
        $customer = Customer::find($request->customer_id);
        $body = $request->body;
        $clearDiacritics = $request->clear_diacritics;
        $owner = User::find(Auth::id());
        try {
            $smsCounter = new SMSCounter();
            $previewRes = MessageService::createTextFromSchema($body, $clearDiacritics, $customer, $owner);
            $dataInfo = $smsCounter->count($previewRes);

            return $this->sendResponse([
                'from' => $owner->name,
                'preview' => $previewRes,
                'letter_count' => $dataInfo->length,
                'letter_next_limit' => $dataInfo->length + $dataInfo->remaining,
                'sms_count' => $dataInfo->messages,
            ], 'Preview returned', 200);
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), 422, 'Error during preview Generation');
        }
    }
}
