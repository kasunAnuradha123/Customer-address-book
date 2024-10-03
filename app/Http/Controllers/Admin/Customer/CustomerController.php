<?php

namespace App\Http\Controllers\Admin\Customer;

use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\Customer\CustomerAddressRepositoryInterface;
use App\Repositories\Interfaces\Customer\CustomerRepositoryInterface;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CustomerController extends Controller
{
    public function __construct(protected CustomerRepositoryInterface $customerRepository, protected CustomerAddressRepositoryInterface $customerAddressRepository)
    {
        $this->customerRepository = $customerRepository;
        $this->customerAddressRepository = $customerAddressRepository;
    }

    /**
     * @return [type]
     */
    public function index()
    {
        $customers = $this->customerRepository->all();
        return Inertia::render('Admin/Customer/Index', [
            'customers' => $customers
        ]);
    }

    public function create(Request $request)
    {
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
        return redirect()->route('admin.customer.index')->with('success', 'Customer created successfully');
    }
}
