<?php

namespace App\Http\Controllers\Api\v1\Announcement\Action;

use App\Events\Announcement\ActionCreated;
use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\Action as ActionRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\Action as ActionResource;
use App\Models\Announcement\Announcement;
use App\Models\Announcement\Action;
use App\Models\Announcement\Service\Service;
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
     * @param ActionRequest $request
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function store(ActionRequest $request, Announcement $announcement)
    {
        $income = 0;
        $services = Service::whereIn('id', $request->get('services'))->get();
        foreach ($services as $service) {
            $income += $service->price;
        }

        $action = Action::create(array_merge($request->validated(), ['owner_id' => Auth::id() || $announcement->owner->id, 'income' => $income]));
        $action->services()->attach($request->get('services'));
        event(new ActionCreated($action));
        return $this->sendResponse(new ActionResource($action), 'Action created!', 201);
    }

    /**
     * @param Announcement $announcement
     * @param Action $action
     * @return JsonResponse
     */
    public function show(Announcement $announcement, Action $action)
    {
        return $this->sendResponse(new ActionResource($action), 'Action returned');
    }

    /**
     * @param ActionRequest $request
     * @param Announcement $announcement
     * @param Action $action
     * @return JsonResponse
     */
    public function update(ActionRequest $request, Announcement $announcement,  Action $action)
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
