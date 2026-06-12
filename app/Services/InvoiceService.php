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

    public function update($id, array $data): array
    {
        $invoice    = Invoice::findOrFail($id);
        $oldProduct = Product::findOrFail($invoice->product_id);
        $newProduct = Product::findOrFail($data['product_id']);
        $oldQuantity = $invoice->quantity;
        $newQuantity = $data['quantity'];

        if ($oldProduct->id === $newProduct->id) {

            $diff = $newQuantity - $oldQuantity;

            if ($diff > 0 && $newProduct->quantity < $diff) {
                return [
                    'status'  => false,
                    'message' => "Insufficient stock. Available stock: {$newProduct->quantity}"
                ];
            }

            if ($diff > 0) $newProduct->decrement('quantity', $diff);
            if ($diff < 0) $newProduct->increment('quantity', abs($diff));

        } else {

            if ($newProduct->quantity < $newQuantity) {
                return [
                    'status'  => false,
                    'message' => "Insufficient stock. Available stock: {$newProduct->quantity}"
                ];
            }

            $oldProduct->increment('quantity', $oldQuantity);
            $newProduct->decrement('quantity', $newQuantity);
        }

        $data['unit_price']   = $newProduct->price;
        $data['total_amount'] = $newProduct->price * $newQuantity;

        $invoice->update($data);

        return [
            'status'  => true,
            'message' => 'Invoice updated successfully.',
            'invoice' => $invoice->fresh()
        ];
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
