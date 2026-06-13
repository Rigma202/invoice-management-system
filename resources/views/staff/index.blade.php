@extends('layouts.app')

@section('content')

<div class="d-flex justify-content-between align-items-center mb-3">

    <h4>Staff Management</h4>

    <button class="btn text-white"
            style="background-color:#C19A6B"
            data-bs-toggle="modal"
            data-bs-target="#createStaffModal">
        + Create Staff
    </button>

</div>

<table id="staffTable" class="table table-dark-green">

    <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>

        @foreach($staffs as $staff)

        <tr>

            <td>{{ $staff->name }}</td>
            <td>{{ $staff->email }}</td>

            <td>

                <button
                    class="btn btn-warning btn-sm editStaffBtn"
                    data-id="{{ $staff->id }}"
                    data-name="{{ $staff->name }}"
                    data-email="{{ $staff->email }}"
                    data-bs-toggle="modal"
                    data-bs-target="#editStaffModal">
                    Edit
                </button>

                <form action="{{ route('staff.destroy',$staff->id) }}"
                      method="POST"
                      class="d-inline">

                    @csrf
                    @method('DELETE')

                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>

                </form>

            </td>

        </tr>

        @endforeach

    </tbody>

</table>

@include('staff.partials.create')
@include('staff.partials.edit')

@endsection

@push('scripts')

<script>
$(document).ready(function(){

    $('#staffTable').DataTable();

    $('.editStaffBtn').on('click', function(){

        $('#edit_staff_id').val($(this).data('id'));
        $('#edit_name').val($(this).data('name'));
        $('#edit_email').val($(this).data('email'));

    });

});
</script>

<script src="{{ asset('js/staff.js') }}"></script>

@endpush
