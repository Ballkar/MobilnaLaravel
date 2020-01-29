<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\ActionPeriodic as ActionPeriodicRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Calendar\ActionPeriodic as ActionResource;
use App\Models\Announcement\Calendar\ActionPeriodic;
use App\Models\Announcement\Announcement;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ActionPeriodicController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $actions = ActionPeriodic::paginate(10);
        return $this->sendResponse(new BaseResourceCollection($actions), 'All periodic actions returned!');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodicRequest $request
     * @return JsonResponse
     */
    public function store(Announcement $announcement, ActionPeriodicRequest $request)
    {
        $actionPeriodic = ActionPeriodic::create(array_merge($request->validated(), ['owner_id' => Auth::id()]));
        return $this->sendResponse(new ActionResource($actionPeriodic), 'Periodic action created', 201);
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodic $actionPeriodic
     * @return JsonResponse
     */
    public function show(Announcement $announcement, ActionPeriodic $actionPeriodic)
    {
        return $this->sendResponse(new ActionResource($actionPeriodic), 'Periodic action returned');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodicRequest $request
     * @param ActionPeriodic $actionPeriodic
     * @return JsonResponse
     */
    public function update(Announcement $announcement, ActionPeriodicRequest $request, ActionPeriodic $actionPeriodic)
    {
        $actionPeriodic->update($request->validated());
        return $this->sendResponse(new ActionResource($actionPeriodic), 'Periodic action updated!');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodic $actionPeriodic
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement, ActionPeriodic $actionPeriodic)
    {
        $actionPeriodic->delete();
        return $this->sendResponse(null, 'Periodic actions deleted successfully!', 204);
    }
}
