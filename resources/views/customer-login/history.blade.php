@extends('layouts.app')

@section('content')

<div class="container">

    <h4 class="mb-3">Order History</h4>

    <table id="historyTable" class="table table-orange">

        <thead>
            <tr>
                <th>Invoice No</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total Amount</th>
                <th>Invoice Date</th>
                <th>Due Date</th>
                <th>Status</th>
            </tr>
        </thead>

        <tbody>

            @foreach($orders as $order)

            <tr>

                <td>{{ $order->invoice_number ?? $order->id }}</td>

                <td>{{ $order->product->name }}</td>

                <td>{{ $order->quantity }}</td>

                <td>₹ {{ number_format($order->total_amount, 2) }}</td>

                <td>{{ $order->invoice_date->format('d-m-Y') }}</td>

                <td>{{ $order->due_date->format('d-m-Y') }}</td>

                <td>
                    @if($order->status === 'completed')

                        <span class="status-confirmed">
                            Order Confirmed
                        </span>

                    @elseif($order->status === 'rejected')

                        <span class="status-rejected">
                            Order Rejected
                        </span>

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

    $('#historyTable').DataTable({
        pageLength: 10,
        order: [[0, 'desc']]
    });

});
</script>

@endpush
