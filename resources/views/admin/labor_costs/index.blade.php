@extends('layouts.app')

@section('title', 'Labor Cost')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex justify-content-between align-items-center">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Labor Cost</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.labor-costs.create') }}" class="btn btn-primary btn-sm">New Labor Entry</a>
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
                            <h4>Labor Cost Records</h4>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Worker</th>
                                    <th>Description</th>
                                    <th>Hours</th>
                                    <th>Rate / Hour</th>
                                    <th>Total</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($laborCosts as $laborCost)
                                    <tr>
                                        <td>{{ $laborCost->id }}</td>
                                        <td>{{ $laborCost->date->format('Y-m-d') }}</td>
                                        <td>{{ $laborCost->worker_name }}</td>
                                        <td>{{ $laborCost->description }}</td>
                                        <td>{{ number_format($laborCost->hours, 2) }}</td>
                                        <td>{{ number_format($laborCost->rate_per_hour, 2) }}</td>
                                        <td>{{ number_format($laborCost->total_amount, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.labor-costs.edit', $laborCost) }}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>

                                            <form method="POST"
                                                  action="{{ route('admin.labor-costs.destroy', $laborCost) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No labor cost records found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $laborCosts->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

