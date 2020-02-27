<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\ActionSingle as ActionSingleRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Calendar\ActionSingle as ActionResource;
use App\Models\Announcement\Announcement;
use App\Models\Announcement\Action;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActionsController extends Controller
{
    use ApiCommunication;
    /**
     * @return JsonResponse
     */
    public function index()
    {
        $actions = Action::paginate(10);
        return $this->sendResponse(new BaseResourceCollection($actions), 'All actions returned!');
    }

    /**
     * @param ActionSingleRequest $request
     * @return JsonResponse
     */
    public function store(ActionSingleRequest $request)
    {
        $action = Action::create(array_merge($request->validated(), ['owner_id' => Auth::id()]));
        return $this->sendResponse(new ActionResource($action), 'Actions created!', 201);
    }

    /**
     * @param Announcement $announcement
     * @param ActionSingle $action
     * @return JsonResponse
     */
    public function show(Announcement $announcement, Action $action)
    {
        return $this->sendResponse(new ActionResource($action), 'Action returned');
    }

    /**
     * @param ActionSingleRequest $request
     * @param Announcement $announcement
     * @param ActionSingle $action
     * @return JsonResponse
     */
    public function update(ActionSingleRequest $request, Announcement $announcement,  Action $action)
    {
        $action->update($request->validated());
        return $this->sendResponse(new ActionResource($action), 'Action updated');
    }

    /**
     * @param Announcement $announcement
     * @param Action $action
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement, Action $action)
    {
        $action->delete();
        return $this->sendResponse(null, 'Action deleted', 204);
    }
}
