<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Newsletter\UpdateNewsletterRequest;
use App\Models\Newsletter;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $announcements = Newsletter::paginate(10);
        return $this->sendResponse($announcements, 'All newsletters returned');

    }

    /**
     * @param UpdateNewsletterRequest $request
     * @param Newsletter $newsletter
     * @return JsonResponse
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        $newsletter->update($request->validated());

        return $this->sendResponse($newsletter, 'Update Success!', 200);

    }

    /**
     * @param Newsletter $newsletter
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return $this->sendResponse(null, 'Newsletter deleted deleted', 200);
    }
}
