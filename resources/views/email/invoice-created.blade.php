<h2>Invoice Created</h2>

<p>Hello {{ $invoice->customer->name }},</p>

<p>Your invoice has been created.</p>

<p>
    Invoice Number: {{ $invoice->invoice_number }}
</p>

<p>
    Product: {{ $invoice->product->name }}
</p>

<p>
    Quantity: {{ $invoice->quantity }}
</p>

<p>
    Total Amount: ₹{{ $invoice->total_amount }}
</p>

<p>
    Due Date: {{ $invoice->due_date->format('d M Y') }}
</p>

<p>Thank you.</p>
