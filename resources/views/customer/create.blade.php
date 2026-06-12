@extends('layouts.app')
@section('content')
<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h4 class="mb-0">Create Customer</h4>
                </div>

                <div class="card-body">
                    <div class="card-body">

                        <form action="{{ route('customers.store') }}" method="POST" id="customerForm">

                            @csrf

                            <div class="mb-2">
                                <label class="form-label">Name</label>

                                <input type="text" id="name"
                                    name="name"
                                    class="form-control"
                                    >

                                    <small id="name_error" class="text-danger"></small>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Email</label>

                                <input type="email" id="email"
                                    name="email"
                                    class="form-control"
                                    >

                                <small id="email_error" class="text-danger"></small>
                            </div>

                            <div class="mb-2">
                                <label class="form-label">Phone</label>

                                <input type="text" id="phone"
                                    name="phone"
                                    class="form-control"
                                    >

                                    <small id="phone_error" class="text-danger"></small>
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Address</label>

                                <textarea name="address"
                                    class="form-control"
                                    rows="3" id="address"
                                ></textarea>

                                    <small id="address_error" class="text-danger"></small>
                            </div>

                            <div class="d-flex gap-2">

                                <button type="submit"
                                    class="btn text-white"
                                    style="background-color:#C19A6B;">
                                    Create
                                </button>

                                <a href="{{ route('customers.index') }}"
                                    class="btn btn-secondary">
                                    Cancel
                                </a>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>
    @endsection
@push('scripts')
<script src="{{ asset('js/customer.js') }}"></script>
@endpush
