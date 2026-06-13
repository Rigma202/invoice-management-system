<div class="card invoice-card">

    <div class="invoice-card-header d-flex justify-content-between align-items-center">
        <h5 class="mb-0">Invoice #{{ $invoice->id }}</h5>

        <button
            type="button"
            class="btn-close btn-close-white"
            data-bs-dismiss="modal"
            aria-label="Close">
        </button>
    </div>
    <div class="card-body">

        <div class="row g-3">

            <div class="col-md-6">
                <div class="invoice-section">
                    <div class="invoice-section-title">
                        Customer Information
                    </div>

                    <p>
                        <span class="invoice-label">Customer:</span>
                        <span class="invoice-value">
                            {{ $invoice->customer->name }}
                        </span>
                    </p>

                    <p>
                        <span class="invoice-label">Status:</span>

                        <span class="status-badge
                            @if($invoice->status == 'paid')
                                status-paid
                            @elseif($invoice->status == 'overdue')
                                status-overdue
                            @else
                                status-sent
                            @endif">
                            {{ ucfirst($invoice->status) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="invoice-section">
                    <div class="invoice-section-title">
                        Product Information
                    </div>

                    <p>
                        <span class="invoice-label">Product:</span>
                        {{ $invoice->product->name }}
                    </p>

                    <p>
                        <span class="invoice-label">Quantity:</span>
                        {{ $invoice->quantity }}
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="invoice-section">
                    <div class="invoice-section-title">
                        Pricing
                    </div>

                    <p>
                        <span class="invoice-label">Unit Price:</span>
                        ₹{{ number_format($invoice->unit_price, 2) }}
                    </p>

                    <p>
                        <span class="invoice-label">Total Amount:</span>
                        <span class="invoice-total">
                            ₹{{ number_format($invoice->total_amount, 2) }}
                        </span>
                    </p>
                </div>
            </div>

            <div class="col-md-6">
                <div class="invoice-section">
                    <div class="invoice-section-title">
                        Dates
                    </div>

                    <p>
                        <span class="invoice-label">Invoice Date:</span>
                        {{ $invoice->invoice_date->format('d M Y') }}
                    </p>

                    <p>
                        <span class="invoice-label">Due Date:</span>
                        {{ $invoice->due_date->format('d M Y') }}
                    </p>
                </div>
            </div>

        </div>

    </div>

</div>
