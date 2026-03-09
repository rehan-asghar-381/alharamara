@extends('layouts.app')

@section('title', 'Daily Expenses')

@section('content')
    <div class="container-fluid">
        <div class="row g-4">
            <div class="col-12">
                <div class="card ">
                    <div class="card-body card-breadcrumb d-flex justify-content-between align-items-center">
                        <div class="page-title-box mb-0">
                            <h4 class="mb-0">Daily Expenses</h4>
                        </div>
                        <div>
                            <a href="{{ route('admin.daily-expenses.create') }}" class="btn btn-primary btn-sm">New Expense</a>
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
                            <h4>Daily Expense Records</h4>
                        </div>

                        <div class="table-responsive text-nowrap">
                            <table class="table table-nowrap mb-0">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Date</th>
                                    <th>Expense Type</th>
                                    <th>Description</th>
                                    <th>Amount</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @forelse ($dailyExpenses as $expense)
                                    <tr>
                                        <td>{{ $expense->id }}</td>
                                        <td>{{ $expense->date->format('Y-m-d') }}</td>
                                        <td>{{ $expense->expenseType->name ?? '-' }}</td>
                                        <td>{{ $expense->description }}</td>
                                        <td>{{ number_format($expense->amount, 2) }}</td>
                                        <td>
                                            <a href="{{ route('admin.daily-expenses.edit', $expense) }}"
                                               class="btn btn-sm btn-outline-primary">Edit</a>

                                            <form method="POST"
                                                  action="{{ route('admin.daily-expenses.destroy', $expense) }}"
                                                  class="d-inline"
                                                  onsubmit="return confirm('Are you sure you want to delete this expense?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="btn btn-sm btn-outline-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">No daily expenses found.</td>
                                    </tr>
                                @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $dailyExpenses->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

