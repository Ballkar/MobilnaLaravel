<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\ActionPeriodic as ActionPeriodicRequest;
use App\Models\ActionPeriodic;
use App\Models\Announcement;
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
        return $this->sendResponse($actions, 'All actions returned');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodicRequest $request
     * @return JsonResponse
     */
    public function store(Announcement $announcement, ActionPeriodicRequest $request)
    {
        $action = ActionPeriodic::create(array_merge($request->validated(), ['user_id' => Auth::id()]));
        return $this->sendResponse($action, 'All actions returned');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodic $actionPeriodic
     * @return JsonResponse
     */
    public function show(Announcement $announcement, ActionPeriodic $actionPeriodic)
    {
        return $this->sendResponse($actionPeriodic, 'All actions returned');
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
        return $this->sendResponse($actionPeriodic, 'All actions returned');
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
        return $this->sendResponse(null, 'All actions returned');
    }
}
