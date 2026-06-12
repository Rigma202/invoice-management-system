@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h4 class="mb-0">Edit Customer</h4>
                </div>

                <div class="card-body">

                    <form id="customerEditForm">

                        @csrf
                        @method('PUT')

                        <input type="hidden"
                               id="customer_id"
                               value="{{ $customer->id }}">

                        <div class="mb-2">
                            <label class="form-label">Name</label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   value="{{ $customer->name }}">

                            <small id="name_error" class="text-danger"></small>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Email</label>

                            <input type="email"
                                   id="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ $customer->email }}">

                            <small id="email_error" class="text-danger"></small>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Phone</label>

                            <input type="text"
                                   id="phone"
                                   name="phone"
                                   class="form-control"
                                   value="{{ $customer->phone }}">

                            <small id="phone_error" class="text-danger"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Address</label>

                            <textarea id="address"
                                      name="address"
                                      rows="3"
                                      class="form-control">{{ $customer->address }}</textarea>

                            <small id="address_error" class="text-danger"></small>
                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn text-white"
                                    style="background-color:#C19A6B;">
                                Update
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
<script src="{{ asset('js/customer-edit.js') }}"></script>
@endpush
