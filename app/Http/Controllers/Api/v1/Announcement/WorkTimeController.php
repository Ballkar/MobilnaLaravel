<?php

namespace App\Http\Controllers\Api\v1\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\WorkTime as ActionPeriodicRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Announcement\WorkTime as WorkTimeResource;
use App\Models\Announcement\WorkTime;
use App\Models\Announcement\Announcement;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WorkTimeController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $workTimes = WorkTime::paginate(10);
        return $this->sendResponse(new BaseResourceCollection($workTimes), 'All work time returned!');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodicRequest $request
     * @return JsonResponse
     */
    public function store(Announcement $announcement, ActionPeriodicRequest $request)
    {
        $workTime = WorkTime::create(array_merge($request->validated(), ['owner_id' => Auth::id()]));
        return $this->sendResponse(new WorkTimeResource($workTime), 'Work time created', 201);
    }

    /**
     * @param Announcement $announcement
     * @param WorkTime $workTime
     * @return JsonResponse
     */
    public function show(Announcement $announcement, WorkTime $workTime)
    {
        return $this->sendResponse(new WorkTimeResource($workTime), 'Work time returned');
    }

    /**
     * @param Announcement $announcement
     * @param ActionPeriodicRequest $request
     * @param WorkTime $workTime
     * @return JsonResponse
     */
    public function update(Announcement $announcement, ActionPeriodicRequest $request, WorkTime $workTime)
    {
        $workTime->update($request->validated());
        return $this->sendResponse(new WorkTimeResource($workTime), 'Work time updated!');
    }

    /**
     * @param Announcement $announcement
     * @param WorkTime $workTime
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement, WorkTime $workTime)
    {
        $workTime->delete();
        return $this->sendResponse(null, 'Work time deleted successfully!', 204);
    }
}
