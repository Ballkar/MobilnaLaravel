<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\ApiCommunication;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Newsletter\StoreNewsletterRequest;
use App\Models\Newsletter;

class NewsletterController extends Controller
{
    use ApiCommunication;

    public function store(StoreNewsletterRequest $request)
    {
        return $this->sendResponse(Newsletter::create($request->validated()), 'Newsletter added');
    }

    public function destroy(Newsletter $newsletter)
    {
        $newsletter->delete();
        return $this->sendResponse(null, 'Newsletter deleted', 200);
    }
}
