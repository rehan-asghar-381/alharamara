@extends('layouts.app')

@section('title', 'Edit Daily Expense')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex align-items-center justify-content-between">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Edit Daily Expense</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.daily-expenses.index') }}" class="btn btn-outline-secondary btn-sm">
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
                            <h4>Daily Expense Details</h4>
                        </div>

                        <form method="POST" action="{{ route('admin.daily-expenses.update', $dailyExpense) }}">
                            @method('PUT')
                            @include('admin.daily_expenses.form', [
                                'submitLabel' => 'Update Daily Expense',
                            ])
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

