@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">

    <h4>Customers</h4>

    <a href="{{ route('customers.create') }}"
       class="btn text-white"
       style="background-color: #C19A6B;">
        + Create Customer
    </a>

</div>
<table id="customerTable" class="table table-dark-green">

    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($customers as $customer)

        <tr>

            <td>{{ $customer->name }}</td>
            <td>{{ $customer->email }}</td>
            <td>{{ $customer->phone }}</td>

            <td>
                <a href="{{ route('customers.edit',$customer->id) }}"
                    class="btn btn-warning btn-sm">
                    Edit
                </a>

            <form method="POST"
                action="{{ route('customers.destroy',$customer->id) }}"
                class="d-inline delete-form"
                data-customer-name="{{ $customer->name }}">

                @csrf
                @method('DELETE')

                <button type="submit" class="btn btn-danger btn-sm">
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

    $('#customerTable').DataTable();

});
</script>
<script src="{{ asset('js/customer-edit.js') }}"></script>
@endpush

