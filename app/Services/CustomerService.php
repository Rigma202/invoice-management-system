<?php
namespace App\Services;

use App\Models\Customer;

class CustomerService
{
    public function getAll()
    {
        return Customer::latest()->get();
    }

    public function find($id)
    {
        return Customer::findOrFail($id);
    }

    public function store(array $data)
    {
        return Customer::create($data);
    }

    public function update($id, array $data)
    {
        $customer = Customer::findOrFail($id);

        $customer->update($data);

        return $customer;
    }

    public function delete($id)
    {
        $customer = Customer::findOrFail($id);

        return $customer->delete();
    }
}
