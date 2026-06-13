@extends('layouts.app')

@section('content')

<div class="container">

    <h4 class="mb-3">My Orders</h4>

    <table id="ordersTable" class="table table-striped table-bordered">

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

                        <span class="badge bg-success">
                            Order Confirmed
                        </span>

                    @elseif($order->status === 'rejected')

                        <span class="badge bg-danger">
                            Order Rejected
                        </span>

                    @else

                        <button
                            class="btn btn-success btn-sm acceptOrder"
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

            </tr>

            @endforeach

        </tbody>

    </table>

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
