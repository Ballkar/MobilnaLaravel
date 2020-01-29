<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Newsletter\StoreNewsletterRequest;
use App\Models\Newsletter;
use App\Http\Resources\Newsletter as NewsletterResource;

class NewsletterController extends Controller
{
    use ApiCommunication;

    public function store(StoreNewsletterRequest $request)
    {
        $newsletter = Newsletter::create($request->validated());
        return $this->sendResponse(new NewsletterResource($newsletter), 'Newsletter added');
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return $this->sendResponse(null, 'Newsletter deleted', 204);
    }
}
