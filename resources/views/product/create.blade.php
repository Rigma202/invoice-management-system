@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h4 class="mb-0">Create Product</h4>
                </div>

                <div class="card-body">

                    <form id="productForm">

                        @csrf

                        <div class="mb-2">
                            <label class="form-label">Product Name</label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control">

                            <small id="name_error" class="text-danger"></small>
                        </div>

                        <div class="mb-2">
                            <label class="form-label">Price</label>

                            <input type="number"
                                   step="0.01"
                                   id="price"
                                   name="price"
                                   class="form-control">

                            <small id="price_error" class="text-danger"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>

                            <textarea id="description"
                                      name="description"
                                      rows="3"
                                      class="form-control"></textarea>

                            <small id="description_error" class="text-danger"></small>
                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn text-white"
                                    style="background-color:#C19A6B;">
                                Create
                            </button>

                            <a href="{{ route('products.index') }}"
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
<script src="{{ asset('js/product.js') }}"></script>
@endpush
