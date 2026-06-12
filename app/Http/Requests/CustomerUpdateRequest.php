<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     */
    public function rules(): array
    {
        return [
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone' => 'required|regex:/^[0-9]+$/|min:10|max:10',
            'address' => 'required|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'Customer name is required.',
            'email.required'   => 'Email is required.',
            'email.email'      => 'Please enter a valid email address.',
            'phone.required'   => 'Phone number is required.',
            'phone.min'   => 'Phone number is required and must be 10 digits.',
            'phone.max'   => 'Phone number is required and must be 10 digits.',
            'address.required' => 'Address is required.',
        ];
    }
}
