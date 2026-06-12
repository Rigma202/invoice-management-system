@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h4>Invoices</h4>

    <a href="{{ route('invoices.create') }}"
       class="btn text-white"
       style="background-color:#C19A6B;">
        + Create Invoice
    </a>

</div>

<table class="table" id="invoiceTable">

    <thead>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Unit Price</th>
            <th>Total</th>
            <th>Invoice Date</th>
            <th>Due Date</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($invoices as $invoice)

        <tr>

            <td>{{ $invoice->id }}</td>

            <td>{{ $invoice->customer->name }}</td>

            <td>{{ $invoice->product->name }}</td>

            <td>{{ $invoice->quantity }}</td>

            <td>₹{{ number_format($invoice->unit_price, 2) }}</td>

            <td>₹{{ number_format($invoice->total_amount, 2) }}</td>

            <td>{{ $invoice->invoice_date->format('d-m-Y') }}</td>

            <td>{{ $invoice->due_date->format('d-m-Y') }}</td>

            <td>{{ ucfirst($invoice->status) }}</td>
            <td>

                <a href="{{ route('invoices.edit', $invoice->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('invoices.destroy', $invoice->id) }}"
                      class="d-inline delete-form"
                      data-invoice-id="{{ $invoice->id }}">

                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="btn btn-danger btn-sm">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@endsection

@push('scripts')

<script>

$(document).ready(function () {

    $('#invoiceTable').DataTable();

    $('.delete-form').on('submit', function(e){

        e.preventDefault();

        let form = this;

        let invoiceId = $(this).data('invoice-id');

        Swal.fire({
            title: 'Delete Invoice?',
            text: 'Are you sure you want to delete Invoice #' + invoiceId + '?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Yes, Delete'
        }).then((result) => {

            if(result.isConfirmed){
                form.submit();
            }

        });

    });

});

</script>

@endpush
