@extends('layouts.app')
@section('content')

    <div class="container-fluid py-4">

        <!-- Statistics Cards -->
        <div class="row g-4 mb-4">

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Total Invoices</h6>
                        <h2 class="fw-bold text-primary">

                        </h2>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Most Sold Product</h6>
                        <h4 class="fw-bold text-success">

                        </h4>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm border-0">
                    <div class="card-body text-center">
                        <h6 class="text-muted">Least Sold Product</h6>
                        <h4 class="fw-bold text-danger">

                        </h4>
                    </div>
                </div>
            </div>

        </div>

        <!-- Recent Invoices -->
        <div class="card shadow-sm border-0">

            <div class="card-header bg-white">
                <h5 class="mb-0">Recent Invoices</h5>
            </div>

            <div class="card-body">

                <div class="table-responsive">

                    <table class="table table-hover">

                        <thead class="table-light">
                            <tr>
                                <th>Invoice No</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Date</th>
                            </tr>
                        </thead>

                        <tbody>

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

    </div>
@endsection
