<?php

namespace App\Services;

use App\Models\Invoice;
use App\Models\Product;
use App\Models\Customer;

class InvoiceService
{
    public function getAll()
    {
        return Invoice::with([
            'customer',
            'product'
        ])->latest()->get();
    }

    public function find($id)
    {
        return Invoice::with([
            'customer',
            'product'
        ])->findOrFail($id);
    }

    public function store(array $data): array
    {
        $product = Product::findOrFail($data['product_id']);

        if ($product->quantity < $data['quantity']) {
            return [
                'status' => false,
                'message' => "Insufficient stock. Available stock: {$product->quantity}"
            ];
        }

        $data['unit_price'] = $product->price;
        $data['total_amount'] = $product->price * $data['quantity'];

        $invoice = Invoice::create($data);

        $product->decrement('quantity', $data['quantity']);

        return [
            'status' => true,
            'message' => 'Invoice created successfully.',
            'invoice' => $invoice
        ];
    }

    public function update($id,array $data)
    {
        $invoice = Invoice::findOrFail($id);

        $product = Product::findOrFail(
            $data['product_id']
        );

        $data['unit_price'] = $product->price;

        $data['total_amount'] =
            $product->price * $data['quantity'];

        $invoice->update($data);

        return $invoice;
    }

    public function delete($id)
    {
        return Invoice::findOrFail($id)->delete();
    }
    public function getData()
    {
        return [
            'customers' => Customer::orderBy('name')->get(),
            'products'  => Product::orderBy('name')->get(),
        ];
    }
}
