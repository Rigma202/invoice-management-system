<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class CustomerOrderController extends Controller
{
    public function index()
    {
        $customer = auth()->user()->customer;
        $orders = Invoice::with('product')
            ->where('customer_id', $customer->id)
            ->where('status', 'sent')
            ->latest()
            ->get();
        return view('customer-login.orders', compact('orders'));
    }
    public function history()
    {
        $customer = auth()->user()->customer;

        $orders = Invoice::with('product')
            ->where('customer_id', $customer->id)
            ->whereIn('status', ['completed', 'rejected'])
            ->latest()
            ->get();

        return view('customer-login.history', compact('orders'));
    }
    public function acceptOrder($id)
    {
        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'status' => 'completed'
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Congratulations! Your order has been confirmed.'
        ]);
    }

    public function rejectOrder(Request $request, $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ]);

        $invoice = Invoice::findOrFail($id);

        $invoice->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
        ]);

        return response()->json([
            'status' => true,
            'message' => 'Order rejected successfully.'
        ]);
    }
}
