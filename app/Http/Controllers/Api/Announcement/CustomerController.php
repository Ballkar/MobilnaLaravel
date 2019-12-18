<?php

namespace App\Http\Controllers\Api\Announcement;

use App\Http\Controllers\ApiCommunication;
use App\Http\Requests\Api\Announcement\StoreCustomerRequest;
use App\Http\Requests\Api\Announcement\UpdateCustomerRequest;
use App\Http\Resources\Announcement\Customer as CustomerResource;
use App\Models\Announcement\Customer;
use Exception;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class CustomerController extends Controller
{
    use ApiCommunication;

    /**
     * @return JsonResponse
     */
    public function index()
    {
        $customers = Customer::paginate(15);
        return $this->sendResponse(new CustomerResource($customers), 'All customers returned');
    }

    /**
     * @param StoreCustomerRequest $request
     * @return JsonResponse
     */
    public function store(StoreCustomerRequest $request)
    {
        $customer = Customer::create($request->validated());
        return $this->sendResponse(new CustomerResource($customer), 'Customer Added');
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
        return $this->sendResponse(null, 'Category deleted', 200);
    }
}
