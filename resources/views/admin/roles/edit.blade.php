@extends('layouts.app')

@section('title', 'Edit Role')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex align-items-center justify-content-between">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Edit Role</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.roles.index') }}" class="btn btn-outline-secondary btn-sm">Back to
                                Roles</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 box-margin">
                <div class="card">
                    <div class="card-body">
                        <div class="card-title">
                            <h4>Role Details</h4>
                        </div>

                        <form method="POST" action="{{ route('admin.roles.update', $role) }}">
                            @method('PUT')
                            @include('admin.roles.form', [
                                'submitLabel' => 'Update Role',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

