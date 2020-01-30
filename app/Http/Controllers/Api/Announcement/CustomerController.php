<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\StoreCustomerRequest;
use App\Http\Requests\Api\Announcement\UpdateCustomerRequest;
use App\Http\Resources\Announcement\Customer as CustomerResource;
use App\Http\Resources\Announcement\CustomerCollection;
use App\Models\Announcement\Customer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    use ApiCommunication;

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $limit = $request->limit ? $request->limit : 10;
        $customers = Customer::paginate($limit);

        return $this->sendResponse(new CustomerCollection($customers), 'All customers returned');
    }

    /**
     * @param StoreCustomerRequest $request
     * @return JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create(array_merge($request->validated(), [
            'owner_id' => Auth::id(),
        ]));
        return $this->sendResponse(new CustomerResource($customer), 'Customer Added', 201);
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     */
    public function show(Customer $customer)
    {
        return $this->sendResponse(new CustomerResource($customer), 'Customer returned');
    }

    /**
     * @param UpdateCustomerRequest $request
     * @param Customer $customer
     * @return JsonResponse
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());
        return $this->sendResponse(new CustomerResource($customer), 'Customer updated');
    }

    /**
     * @param Customer $customer
     * @return JsonResponse
     * @throws Exception
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $this->sendResponse(null, 'Category deleted', 204);
    }
}
