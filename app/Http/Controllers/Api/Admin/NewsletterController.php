<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
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
     * @param Request $request
     * @param Newsletter $newsletter
     * @return JsonResponse
     */
    public function update(Request $request, Newsletter $newsletter)
    {
        $newsletter->update($request->all());

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
