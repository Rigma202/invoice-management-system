<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:customers,email',
            'phone' => 'required|regex:/^[0-9]+$/|size:10|unique:customers,phone',
            'address' => 'required|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Customer name is required.',
            'email.required' => 'Email is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'Email already exists.',
            'phone.required'   => 'Phone number is required.',
            'phone.min'   => 'Phone number is required and must be 10 digits.',
            'phone.max'   => 'Phone number is required and must be 10 digits.',
            'phone.unique'   => 'Phone number is already in use. Try another one.',
            'address.required' => 'Address is required.',
        ];
    }
}
