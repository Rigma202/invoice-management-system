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

<table class="table" id="productTable">

    <thead>
        <tr>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($products as $product)

        <tr>
            <td>{{ $product->name }}</td>

            <td>₹{{ number_format($product->price,2) }}</td>

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

$(document).ready(function () {

    $('#productTable').DataTable();

    $('.delete-form').on('submit', function(e){

        e.preventDefault();

        let form = this;

        let productName = $(this).data('product-name');

        Swal.fire({
            title: 'Delete Product?',
            text: 'Are you sure you want to delete "' + productName + '"?',
            icon: 'warning',
            showCancelButton: true,
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
