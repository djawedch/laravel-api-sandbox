<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\StoreCustomerRequest;
use App\Http\Requests\UpdateCustomerRequest;
use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\{CustomerResource, CustomerCollection};
use Illuminate\Http\Request;
use App\Filters\V1\CustomersFilter;

class CustomerController extends Controller
{
    public function index(Request $request)
    {
        $filter = new CustomersFilter();
        $queryItems = $filter->transform($request); // [['column', 'operator', 'value']]

        if (count($queryItems) == 0) {
            return new CustomerCollection(Customer::paginate());
        } else {
            $customers = Customer::where($queryItems)->paginate();

            return new CustomerCollection($customers->appends($request->query()));
        }
    }

    public function store(StoreCustomerRequest $request)
    {
        //
    }

    public function show(Customer $customer)
    {
        return new CustomerResource($customer);
    }
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        //
    }

    public function destroy(Customer $customer)
    {
        //
    }
}
