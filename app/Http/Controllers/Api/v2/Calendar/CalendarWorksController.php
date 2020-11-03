<?php

namespace App\Http\Controllers\Api\v2\Calendar;

use App\Http\Controllers\ApiCommunication;
use App\Http\Resources\Calendar\Work as WorkResource;
use App\Http\Resources\Calendar\WorkCollection;
use App\Models\Calendar\Works;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CalendarWorksController extends Controller
{
    use ApiCommunication;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->get('limit') ? $request->get('limit') : 10;
        $works = Works::paginate($limit);

        return $this->sendResponse(new WorkCollection($works), 'All works returned');
    }

    // /**
    //  * @param CustomerRequest $request
    //  * @return JsonResponse
    //  */
    // public function store(CustomerRequest $request)
    // {
    //     $customer = Customer::create(array_merge($request->validated(), [
    //         'owner_id' => Auth::id(),
    //     ]));
    //     return $this->sendResponse(new CustomerResource($customer), 'Customer Added', 201);
    // }

    // /**
    //  * @param Customer $customer
    //  * @return JsonResponse
    //  */
    // public function show(Customer $customer)
    // {
    //     return $this->sendResponse(new CustomerResource($customer), 'Customer returned');
    // }

    // /**
    //  * @param CustomerRequest $request
    //  * @param Customer $customer
    //  * @return JsonResponse
    //  */
    // public function update(CustomerRequest $request, Customer $customer)
    // {
    //     $customer->update($request->validated());
    //     return $this->sendResponse(new CustomerResource($customer), 'Customer updated');
    // }

    // /**
    //  * @param Customer $customer
    //  * @return JsonResponse
    //  * @throws Exception
    //  */
    // public function destroy(Customer $customer)
    // {
    //     $customer->delete();
    //     return $this->sendResponse(null, 'Category deleted', 204);
    // }
}
