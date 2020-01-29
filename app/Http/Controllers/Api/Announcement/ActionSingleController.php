<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\ActionSingle as ActionSingleRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Calendar\ActionSingle as ActionResource;
use App\Models\Announcement\Announcement;
use App\Models\Announcement\Calendar\ActionSingle;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActionSingleController extends Controller
{
    use ApiCommunication;
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $actions = ActionSingle::paginate(10);
        return $this->sendResponse(new BaseResourceCollection($actions), 'All single actions returned!');
    }

    /**
     * @param ActionSingleRequest $request
     * @return JsonResponse
     */
    public function store(ActionSingleRequest $request)
    {
        $actionSingle = ActionSingle::create(array_merge($request->validated(), ['owner_id' => Auth::id()]));
        return $this->sendResponse(new ActionResource($actionSingle), 'Single actions created!', 201);
    }

    /**
     * @param Announcement $announcement
     * @param ActionSingle $actionSingle
     * @return JsonResponse
     */
    public function show(Announcement $announcement, ActionSingle $actionSingle)
    {
        return $this->sendResponse(new ActionResource($actionSingle), 'Single action returned');
    }

    /**
     * @param ActionSingleRequest $request
     * @param Announcement $announcement
     * @param ActionSingle $actionSingle
     * @return JsonResponse
     */
    public function update(ActionSingleRequest $request, Announcement $announcement,  ActionSingle $actionSingle)
    {
        $actionSingle->update($request->validated());
        return $this->sendResponse(new ActionResource($actionSingle), 'Single action updated');
    }

    /**
     * @param Announcement $announcement
     * @param ActionSingle $actionSingle
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement, ActionSingle $actionSingle)
    {
        $actionSingle->delete();
        return $this->sendResponse(null, 'Single action deleted', 204);
    }
}
