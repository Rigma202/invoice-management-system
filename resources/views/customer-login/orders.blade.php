@extends('layouts.app')

@section('content')

<div class="container">

    <h4 class="mb-2">My Orders</h4>

<table id="ordersTable" class="table table-orange">

        <thead>
            <tr>
                <th>Invoice No</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            @foreach($orders as $order)

            <tr>

                <td>{{ $order->invoice_number ?? $order->id }}</td>

                <td>{{ $order->product->name }}</td>

                <td>{{ $order->quantity }}</td>

                <td>₹ {{ number_format($order->total_amount, 2) }}</td>

                <td>{{ $order->invoice_date->format('d-m-Y')  }}</td>

                <td>{{ $order->due_date->format('d-m-Y')  }}</td>

                <td>

                    @if($order->status === 'completed')

                        <span class="status-confirmed">
                            Order Confirmed
                        </span>

                    @elseif($order->status === 'rejected')

                        <span class="status-rejected">
                             Order Rejected
                        </span>

                    @else

                        <button
                            class="btn acceptOrder text-white btn-sm"
                            data-id="{{ $order->id }}">
                            Accept Order
                        </button>

                        <button
                            class="btn btn-danger btn-sm rejectOrder"
                            data-id="{{ $order->id }}">
                            Reject Order
                        </button>

                    @endif

                </td>

                </td>
            </tr>

            @endforeach

        </tbody>

    </table>
    <div class="modal fade" id="rejectModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">

                <div class="modal-header">
                    <h5>Reject Order</h5>
                    <button type="button"
                            class="btn-close"
                            data-bs-dismiss="modal">
                    </button>
                </div>

                <div class="modal-body">

                    <input type="hidden" id="reject_order_id">

                    <label class="form-label">
                        Reason for rejection
                    </label>

                    <textarea id="rejection_reason"
                            class="form-control"
                            rows="4"></textarea>

                    <small id="rejection_reason_error"
                        class="text-danger">
                    </small>

                </div>

                <div class="modal-footer">

                    <button type="button"
                            class="btn btn-secondary"
                            data-bs-dismiss="modal">
                        Cancel
                    </button>

                    <button type="button"
                            class="btn btn-danger"
                            id="submitReject">
                        Reject Order
                    </button>

                </div>

            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
$(document).ready(function () {

    $('#ordersTable').DataTable();

});
</script>

<script src="{{ asset('js/customer-orders.js') }}"></script>

@endpush
