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
        $password = Str::random(10);

        $user = User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'role'     => 'customer',
            'password' => Hash::make($password),
        ]);

        $customer = Customer::create([
            'user_id' => $user->id,
            'name'    => $data['name'],
            'email'   => $data['email'],
            'phone'   => $data['phone'],
            'address' => $data['address'],
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
