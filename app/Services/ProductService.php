<?php

namespace App\Services;

use App\Models\Product;
use App\Models\Invoice;
class ProductService
{
    public function getAll()
    {
        return Product::latest()->get();
    }

    public function find($id)
    {
        return Product::findOrFail($id);
    }

    public function store(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::findOrFail($id);

        $product->update($data);

        return $product;
    }



    public function delete($id, $force = false)
    {
        $product = Product::findOrFail($id);

        $pendingInvoices = Invoice::where('product_id', $id)
            ->where('status', 'sent')
            ->get();

        if ($pendingInvoices->count() && !$force) {

            return [
                'status' => false,
                'hasInvoices' => true,
                'invoices' => $pendingInvoices
            ];
        }

        Invoice::where('product_id', $id)
            ->where('status', 'sent')
            ->delete();

        $product->delete();

        return [
            'status' => true,
            'message' => 'Product deleted successfully'
        ];
    }
}
