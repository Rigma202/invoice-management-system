@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">

                <div class="card-header">
                    <h4 class="mb-0">Edit Invoice</h4>
                </div>

                <div class="card-body">

                    <form id="invoiceForm" action="{{ route('invoices.update', $invoice->id) }}">

                        @csrf
                        @method('PUT')

                        <div class="row g-3 mb-2">

                            <div class="col-md-6">
                                <label class="form-label">Customer</label>
                                <select id="customer_id" name="customer_id" class="form-select select2">
                                    <option value="">Select Customer</option>
                                    @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}"
                                        {{ $invoice->customer_id == $customer->id ? 'selected' : '' }}>
                                        {{ $customer->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <small id="customer_id_error" class="text-danger"></small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Product</label>
                                <select id="product_id" name="product_id" class="form-select select2">
                                    <option value="">Select Product</option>
                                    @foreach($products as $product)
                                    <option value="{{ $product->id }}"
                                            data-price="{{ $product->price }}"
                                            {{ $invoice->product_id == $product->id ? 'selected' : '' }}>
                                        {{ $product->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <small id="product_id_error" class="text-danger"></small>
                            </div>

                        </div>

                        <div class="row g-3 mb-2">

                            <div class="col-md-6">
                                <label class="form-label">Unit Price</label>
                                <input type="text" id="unit_price" class="form-control" readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Quantity</label>
                                <input type="number"
                                       id="quantity"
                                       name="quantity"
                                       class="form-control"
                                       value="{{ $invoice->quantity }}"
                                       min="1">
                                <small id="quantity_error" class="text-danger"></small>
                            </div>

                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Invoice Date</label>
                                <input type="date"
                                       id="invoice_date"
                                       name="invoice_date"
                                       class="form-control"
                                       value="{{ \Carbon\Carbon::parse($invoice->invoice_date)->format('Y-m-d') }}">
                                <small id="invoice_date_error" class="text-danger"></small>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Due Date</label>
                                <input type="date"
                                       id="due_date"
                                       name="due_date"
                                       class="form-control"
                                       value="{{ \Carbon\Carbon::parse($invoice->due_date)->format('Y-m-d') }}">
                                <small id="due_date_error" class="text-danger"></small>
                            </div>

                        </div>

                        <div class="row g-3 mb-3">

                            <div class="col-md-6">
                                <label class="form-label">Total Amount</label>
                                <input type="text"
                                    id="total_amount"
                                    class="form-control fw-bold"
                                    readonly>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">Status</label>

                                <select id="status"
                                        name="status"
                                        class="form-select">
                                    <option value="sent"
                                        {{ $invoice->status == 'sent' ? 'selected' : '' }}>
                                        Sent
                                    </option>

                                    <option value="paid"
                                        {{ $invoice->status == 'paid' ? 'selected' : '' }}>
                                        Paid
                                    </option>

                                    <option value="overdue"
                                        {{ $invoice->status == 'overdue' ? 'selected' : '' }}>
                                        Overdue
                                    </option>
                                </select>

                                <small id="status_error" class="text-danger"></small>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('invoices.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn text-white" style="background-color:#C19A6B;">
                                Update Invoice
                            </button>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="{{ asset('js/invoice-edit.js') }}"></script>
@endpush
