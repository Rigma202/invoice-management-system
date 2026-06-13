@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h4>Products</h4>

    <a href="{{ route('products.create') }}"
       class="btn text-white"
       style="background-color:#C19A6B;">
        + Create Product
    </a>

</div>

<table id="productTable" class="table table-light-yellow">

    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($products as $product)

        <tr>
            <td>{{ $product->name }}</td>

            <td>₹{{ number_format($product->price,2) }}</td>

            <td>{{ $product->quantity }}</td>

            <td>{{ $product->description }}</td>

            <td>

                <a href="{{ route('products.edit',$product->id) }}"
                   class="btn btn-warning btn-sm">
                    Edit
                </a>

                <form method="POST"
                      action="{{ route('products.destroy',$product->id) }}"
                      class="d-inline delete-form"
                      data-product-name="{{ $product->name }}">

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

$(document).on('submit', '.delete-form', function(e){

    e.preventDefault();

    let form = $(this);
    let url  = form.attr('action');

    $.ajax({
        url: url,
        type: 'DELETE',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content')
        },

        success: function(response){

            if(response.hasInvoices){

                let invoiceList = '';

                response.invoices.forEach(function(invoice){

                    invoiceList +=
                        'Invoice #' + invoice.id +
                        ' | Qty: ' + invoice.quantity +
                        '<br>';
                });

                Swal.fire({
                    title: 'Pending Invoices Found',
                    html:
                        '<p>This product is used in active invoices:</p>' +
                        invoiceList +
                        '<br><b>Deleting this product will also delete these invoices.</b>',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Proceed Anyway'
                }).then((result)=>{

                    if(result.isConfirmed){

                        Swal.fire({
                            title: 'Final Confirmation',
                            text: 'This action cannot be undone.',
                            icon: 'error',
                            showCancelButton: true,
                            confirmButtonText: 'Delete Product & Invoices'
                        }).then((finalResult)=>{

                            if(finalResult.isConfirmed){

                                $.ajax({
                                    url: url,
                                    type: 'DELETE',
                                    data: {
                                        _token: $('meta[name="csrf-token"]').attr('content'),
                                        force_delete: true
                                    },

                                    success: function(res){

                                        Swal.fire(
                                            'Deleted!',
                                            res.message,
                                            'success'
                                        ).then(()=>{
                                            location.reload();
                                        });

                                    }
                                });

                            }

                        });

                    }

                });

                return;
            }

            Swal.fire(
                'Deleted!',
                response.message,
                'success'
            ).then(()=>{
                location.reload();
            });

        }
    });

});
</script>

@endpush
