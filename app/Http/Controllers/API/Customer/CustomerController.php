<?php

namespace App\Http\Controllers\API\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Customer\CustomerCreateRequest;
use App\Http\Requests\API\Customer\CustomerUpdateRequest;
use App\Http\Resources\Customer\CustomerCreateResources;
use App\Http\Resources\Customer\CustomerEditResources;
use App\Http\Resources\Customer\CustomerShowResources;
use App\Repositories\Interfaces\Customer\CustomerAddressRepositoryInterface;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository, protected CustomerAddressRepositoryInterface $customerAddressRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->customerAddressRepository = $customerAddressRepository;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $customers = $this->customerRepository->all();
            return response()->json([
                'message' => 'Customers retrieved successfully',
                'customers' => $customers
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create() {}

    /**
     * Store a newly created resource in storage.
     */
    /**
     * @param CustomerCreateRequest $request
     * 
     * @return [type]
     */
    public function store(CustomerCreateRequest $request)
    {
        try {
            $customer = $this->customerRepository->create($request->all());
            foreach ($request['address'] as $address) {
                $data = [
                    'customer_id' => $customer->id,
                    'number' => $address['number'],
                    'street' => $address['street'],
                    'city' => $address['city'],
                ];
                $this->customerAddressRepository->create($data);
            }
            return response()->json([
                'message' => 'Customer created successfully',
                'customer' => new CustomerCreateResources($customer)

            ], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function show(int $id)
    {
        try {
            $customer = $this->customerRepository->findById($id);
            return response()->json([
                'message' => 'Customer retrieved successfully',
                'customer' => new CustomerShowResources($customer)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        try {
            $customer = $this->customerRepository->findById($id);
            return response()->json([
                'message' => 'Customer data retrieved successfully',
                'customer' => new CustomerEditResources($customer)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * @param int $id
     * 
     * @return [type]
     */
    public function removeAddress(int $id)
    {
        try {
            $address = $this->customerAddressRepository->deleteById($id);
            return response()->json([
                'message' => 'Address removed successfully',
                'address' => $address
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, int $id)
    {
        try {
            $customer = $this->customerRepository->update($id, $request->all());
            foreach ($request['address'] as $address) {
                $this->customerAddressRepository->update(
                    $address['id'],
                    [
                        'number' => $address['number'],
                        'street' => $address['street'],
                        'city' => $address['city'],
                    ]
                );
            }
            return response()->json([
                'message' => 'Customer updated successfully',
                'customer' => $customer
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->customerRepository->deleteById($id);
            return response()->json([
                'message' => 'Customer deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage()], 500);
        }
    }
}
