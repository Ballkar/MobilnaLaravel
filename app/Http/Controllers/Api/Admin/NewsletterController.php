<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Newsletter\UpdateNewsletterRequest;
use App\Http\Resources\BaseResourceCollection;
use App\Http\Resources\Newsletter as NewsletterResource;
use App\Models\Newsletter;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class NewsletterController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $newsletters = Newsletter::paginate(10);
        return $this->sendResponse(new BaseResourceCollection($newsletters), 'All newsletters returned', 200);

    }

    /**
     * @param UpdateNewsletterRequest $request
     * @param Newsletter $newsletter
     * @return JsonResponse
     */
    public function update(UpdateNewsletterRequest $request, Newsletter $newsletter)
    {
        $newsletter->update($request->validated());

        return $this->sendResponse(new NewsletterResource($newsletter), 'Update newsletter Success!', 200);

    }

    /**
     * @param Newsletter $newsletter
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return $this->sendResponse(null, 'Newsletter deleted success!', 204);
    }
}
