@extends('layouts.app')

@section('title', 'Sales')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex justify-content-between align-items-center">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Sales</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.sales.create') }}" class="btn btn-primary btn-sm">New Sale</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="card-title">
                            <h4>Sales Records</h4>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Customer</th>
                                    <th>Wood Type</th>
                                    <th>Qty</th>
                                    <th>Unit</th>
                                    <th>Unit Price</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->id }}</td>
                                        <td>{{ $sale->date->format('Y-m-d') }}</td>
                                        <td>{{ $sale->customer_name }}</td>
                                        <td>{{ $sale->wood_type }}</td>
                                        <td>{{ number_format($sale->quantity, 2) }}</td>
                                        <td>{{ $sale->unit }}</td>
                                        <td>{{ number_format($sale->unit_price, 2) }}</td>
                                        <td>{{ number_format($sale->total_price, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.sales.edit', $sale) }}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>

                                            <form method="POST"
                                                  action="{{ route('admin.sales.destroy', $sale) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this sale?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No sales records found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $sales->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

