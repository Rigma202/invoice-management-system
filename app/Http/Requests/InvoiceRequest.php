<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class InvoiceRequest extends FormRequest
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
     *
     */
    public function rules(): array
    {
        return [
            'customer_id' => 'required|exists:customers,id',
            'product_id' => 'required|exists:products,id',
            'invoice_date' => 'required|date',
            'due_date' => 'required|date|after_or_equal:invoice_date',
            'quantity' => 'required|integer|min:1',
        ];
    }
    public function messages(): array
    {
        return [
            'customer_id.required' => 'Please select a customer.',
            'product_id.required' => 'Please select a product.',
            'invoice_date.required' => 'Invoice date is required.',
            'due_date.required' => 'Due date is required.',
            'due_date.after_or_equal' => 'Due date must be after or same to invoice date.',
            'quantity.required' => 'Quantity is required.',
            'quantity.min' => 'Quantity must be at least 1.',
        ];
    }
}
