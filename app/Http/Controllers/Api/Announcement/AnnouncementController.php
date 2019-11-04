<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\StoreAnnouncementRequest;
use App\Http\Requests\Api\Announcement\UpdateAnnouncementRequest;
use App\Http\Resources\Announcement as AnnouncementResource;
use App\Models\Announcement;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $announcements = Announcement::paginate(10);
        return $this->sendResponse(new AnnouncementResource($announcements), 'All announcement returned');
    }

    /**
     * @param StoreAnnouncementRequest $request
     * @return JsonResponse
     */
    public function store(StoreAnnouncementRequest $request)
    {
        $announcements = Announcement::create(array_merge($request->validated(), ['user_id' => Auth::id()]));
        return $this->sendResponse(new AnnouncementResource($announcements), 'Announcement created');
    }

    /**
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function show(Announcement $announcement)
    {
        return $this->sendResponse(new AnnouncementResource($announcement), 'Category returned', 200);
    }

    /**
     * @param UpdateAnnouncementRequest $request
     * @param Announcement $announcement
     * @return JsonResponse
     */
    public function update(UpdateAnnouncementRequest $request, Announcement $announcement)
    {
        $announcement->update($request->validated());
        return $this->sendResponse(new AnnouncementResource($announcement), 'Announcement updated');
    }

    /**
     * @param Announcement $announcement
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return $this->sendResponse(null, 'Category deleted', 200);
    }
}
