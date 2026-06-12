<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use App\Services\InvoiceService;
use App\Http\Requests\InvoiceRequest;

class InvoiceController extends Controller
{
    public function __construct(
        protected InvoiceService $invoiceService
    ) {}

    public function index()
    {
        $invoices = $this->invoiceService->getAll();

        return view('invoice.index', compact('invoices'));
    }

    public function create()
    {
        $data = $this->invoiceService->getData();
        return view('invoice.create', $data);
    }
    public function store(InvoiceRequest $request)
    {
        $result = $this->invoiceService->store(
            $request->validated()
        );

        if (!$result['status']) {
            return response()->json([
                'status' => false,
                'message' => $result['message']
            ], 422);
        }

        return response()->json([
            'status' => true,
            'message' => $result['message']
        ]);
    }

    public function edit($id)
    {
        $invoice = $this->invoiceService->find($id);

        $customers = Customer::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('invoice.edit', compact('invoice', 'customers', 'products'));
    }

    public function update(InvoiceRequest $request, $id)
    {
        $this->invoiceService->update(
            $id,
            $request->validated()
        );

        return response()->json([
            'status' => true,
            'message' => 'Invoice updated successfully'
        ]);
    }

    public function destroy($id)
    {
        $this->invoiceService->delete($id);

        return redirect()->route('invoices.index');
    }
}
