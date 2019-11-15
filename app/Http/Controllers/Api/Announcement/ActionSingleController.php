<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\ActionSingle as ActionSingleRequest;
use App\Models\Announcement;
use App\Models\ActionSingle;
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
        return $this->sendResponse($actions, 'All actions returned');
    }

    /**
     * @param ActionSingleRequest $request
     * @return JsonResponse
     */
    public function store(ActionSingleRequest $request)
    {
        $action = ActionSingle::create(array_merge($request->validated(), ['owner_id' => Auth::id()]));
        return $this->sendResponse($action, 'All actions returned');
    }

    /**
     * @param Announcement $announcement
     * @param ActionSingle $actionSingle
     * @return JsonResponse
     */
    public function show(Announcement $announcement, ActionSingle $actionSingle)
    {
        return $this->sendResponse($actionSingle, 'Action returned');
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
        return $this->sendResponse($actionSingle, 'All actions returned');
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
        return $this->sendResponse(null, 'Action deleted');
    }
}
