<?php
namespace App\Services;

use App\Models\Customer;
use App\Models\User;
use App\Mail\CustomerCredentialsMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $customer = Customer::create($data);
            $password = Str::random(10);

            User::create([
                'name'     => $data['name'],
                'email'    => $data['email'],
                'role'     => 'customer',
                'password' => Hash::make($password),
            ]);
            Mail::to($customer->email)->queue(new CustomerCredentialsMail($customer, $password));

            return $customer;
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
