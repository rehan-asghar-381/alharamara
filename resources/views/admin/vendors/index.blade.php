@extends('layouts.app')

@section('title', 'Vendors')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex justify-content-between align-items-center">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Vendors</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary btn-sm">New Vendor</a>
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
                            <h4>Vendor List</h4>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Contact Person</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($vendors as $vendor)
                                    <tr>
                                        <td>{{ $vendor->id }}</td>
                                        <td>{{ $vendor->name }}</td>
                                        <td>{{ $vendor->contact_person }}</td>
                                        <td>{{ $vendor->phone }}</td>
                                        <td>{{ $vendor->email }}</td>
                                        <td>
                                            @if($vendor->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admin.vendors.edit', $vendor) }}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>

                                            <form method="POST"
                                                  action="{{ route('admin.vendors.destroy', $vendor) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this vendor?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">No vendors found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $vendors->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

