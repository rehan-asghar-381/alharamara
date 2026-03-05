@extends('layouts.app')

@section('title', 'Stock Entry')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex justify-content-between align-items-center">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Stock Entry / Purchasing</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.purchases.create') }}" class="btn btn-primary btn-sm">New Purchase</a>
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

                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="card-title">
                            <h4>Purchase Records</h4>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Vendor</th>
                                    <th>Wood Type</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Discount</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($purchases as $purchase)
                                    <tr>
                                        <td>{{ $purchase->id }}</td>
                                        <td>{{ $purchase->vendor }}</td>
                                        <td>{{ $purchase->wood_type }}</td>
                                        <td>{{ number_format($purchase->quantity, 2) }}</td>
                                        <td>{{ number_format($purchase->unit_price, 2) }}</td>
                                        <td>{{ number_format($purchase->discount, 2) }}</td>
                                        <td>{{ number_format($purchase->total_price, 2) }}</td>
                                        <td>{{ number_format($purchase->paid_amount, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.purchases.edit', $purchase) }}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>

                                            <form method="POST"
                                                  action="{{ route('admin.purchases.destroy', $purchase) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this purchase?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="9" class="text-center">No purchase records found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $purchases->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

