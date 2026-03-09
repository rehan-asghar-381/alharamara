@extends('layouts.app')

@section('title', 'New Vendor')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex align-items-center justify-content-between">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">New Vendor</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.vendors.index') }}" class="btn btn-outline-secondary btn-sm">
                                Back to List
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Vendor Details</h4>
                        </div>

                        <form method="POST" action="{{ route('admin.vendors.store') }}">
                            @include('admin.vendors.form', [
                                'submitLabel' => 'Save Vendor',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

