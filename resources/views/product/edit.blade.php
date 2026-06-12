@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

        <div class="col-md-6">

            <div class="card shadow-sm">

                <div class="card-header">
                    <h4 class="mb-0">Edit Product</h4>
                </div>

                <div class="card-body">

                    <form id="productEditForm">

                        @csrf
                        @method('PUT')

                        <input type="hidden"
                               id="product_id"
                               value="{{ $product->id }}">

                        <div class="mb-2">
                            <label class="form-label">Product Name</label>

                            <input type="text"
                                   id="name"
                                   name="name"
                                   class="form-control"
                                   value="{{ $product->name }}">

                            <small id="name_error" class="text-danger"></small>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Quantity</label>

                            <input type="number"
                                id="quantity"
                                name="quantity"
                                class="form-control"
                                min="0"
                                value="{{ $product->quantity }}">

                            <small id="quantity_error" class="text-danger"></small>
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Price</label>

                            <input type="number"
                                   step="0.01"
                                   id="price"
                                   name="price"
                                   class="form-control"
                                   value="{{ $product->price }}">

                            <small id="price_error" class="text-danger"></small>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description</label>

                            <textarea id="description"
                                      name="description"
                                      rows="3"
                                      class="form-control">{{ $product->description }}</textarea>

                            <small id="description_error" class="text-danger"></small>
                        </div>

                        <div class="d-flex gap-2">

                            <button type="submit"
                                    class="btn text-white"
                                    style="background-color:#C19A6B;">
                                Update
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
<script src="{{ asset('js/product-edit.js') }}"></script>
@endpush
