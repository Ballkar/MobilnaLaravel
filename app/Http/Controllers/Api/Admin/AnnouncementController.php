<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\UpdateAnnouncementRequest;
use App\Http\Resources\Announcement as AnnouncementResource;
use App\Models\Announcement\Announcement;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

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

        return $this->sendResponse(new AnnouncementResource($announcement), 'Update Success!', 200);
    }

    /**
     * @param Announcement $announcement
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Announcement $announcement)
    {
        $announcement->delete();
        return $this->sendResponse(null, 'Category deleted', 200);
    }
}
