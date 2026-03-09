@extends('layouts.app')

@section('title', 'Edit Expense Type')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex align-items-center justify-content-between">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Edit Expense Type</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.expense-types.index') }}" class="btn btn-outline-secondary btn-sm">
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
                            <h4>Expense Type Details</h4>
                        </div>

                        <form method="POST" action="{{ route('admin.expense-types.update', $expenseType) }}">
                            @method('PUT')
                            @include('admin.expense_types.form', [
                                'submitLabel' => 'Update Expense Type',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

