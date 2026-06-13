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

    <table id="invoiceTable" class="table table-light-brown">

        <thead>
            <tr>
                <th>#</th>
                <th>Customer</th>
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

                <td>₹{{ number_format($invoice->total_amount, 2) }}</td>

                <td>{{ $invoice->invoice_date->format('d-m-Y') }}</td>

                <td>{{ $invoice->due_date->format('d-m-Y') }}</td>

                <td>{{ ucfirst($invoice->status) }}</td>
                <td>
                    <button
                        type="button"
                        class="btn btn-sm view-invoice text-white"
                        style="background-color:#C19A6B;"
                        data-id="{{ $invoice->id }}">
                        View
                    </button>
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

<div class="modal fade" id="invoiceModal" tabindex="-1">
    <div class="modal-dialog modal-lg">


            <div class="modal-body" id="invoiceDetails">
                Loading...
            </div>

        </div>
    </div>
</div>
    @endsection

    @push('scripts')
    <script src="{{ asset('js/invoice.js') }}"></script>
    @endpush
