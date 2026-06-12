<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInvoiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'customer_id'  => 'required|exists:customers,id',
            'product_id'   => 'required|exists:products,id',
            'quantity'     => 'required|integer|min:1',
            'invoice_date' => 'required|date',
            'due_date'     => 'required|date|after_or_equal:invoice_date',
            'status'       => 'required|in:sent,paid,overdue'
        ];
    }

    public function messages(): array
    {
        return [
            'customer_id.required' => 'Please select a customer.',
            'customer_id.exists'   => 'Selected customer is invalid.',
            'product_id.required'  => 'Please select a product.',
            'product_id.exists'    => 'Selected product is invalid.',
            'quantity.required'    => 'Quantity is required.',
            'quantity.integer'     => 'Quantity must be a whole number.',
            'quantity.min'         => 'Quantity must be at least 1.',
            'invoice_date.required'=> 'Invoice date is required.',
            'invoice_date.date'    => 'Invoice date must be a valid date.',
            'due_date.required'    => 'Due date is required.',
            'due_date.date'        => 'Due date must be a valid date.',
            'due_date.after_or_equal' => 'Due date must be on or after the invoice date.',
        ];
    }
}
