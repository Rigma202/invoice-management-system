<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Services\CustomerService;
use App\Http\Requests\CustomerStoreRequest;
use App\Http\Requests\CustomerUpdateRequest;
class CustomerController extends Controller
{
    protected $customerService;

    public function __construct(CustomerService $customerService)
    {
        $this->customerService = $customerService;
    }

    public function index()
    {
        $customers = $this->customerService->getAll();

        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerStoreRequest $request)
    {

        $this->customerService->store($request->validated());
        return response()->json([
            'status' => true,
            'message' => 'Customer created successfully'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        $customer = $this->customerService->find($id);
        return view('customer.edit',compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerUpdateRequest $request, Customer $customer)
    {
        $this->customerService->update(
            $customer->id,
            $request->validated()
        );

        return response()->json([
            'status' => true,
            'message' => 'Customer updated successfully'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $this->customerService->delete($id);

        return redirect()
            ->route('customers.index')
            ->with('success', 'Customer deleted successfully');
    }
}
