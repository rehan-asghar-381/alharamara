<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DailyExpense;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class DailyExpenseController extends Controller
{
    public function index()
    {
        $dailyExpenses = DailyExpense::with('expenseType')
            ->orderByDesc('date')
            ->paginate(10);

        return view('admin.daily_expenses.index', compact('dailyExpenses'));
    }

    public function create()
    {
        $expenseTypes = ExpenseType::where('is_active', true)
            ->orderBy('name')
            ->get();

        $dailyExpense = new DailyExpense([
            'date' => now()->toDateString(),
        ]);

        return view('admin.daily_expenses.create', compact('dailyExpense', 'expenseTypes'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        DailyExpense::create($data);

        return redirect()
            ->route('admin.daily-expenses.create')
            ->with('success', 'Daily expense recorded successfully.');
    }

    public function edit(DailyExpense $dailyExpense)
    {
        $expenseTypes = ExpenseType::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.daily_expenses.edit', compact('dailyExpense', 'expenseTypes'));
    }

    public function update(Request $request, DailyExpense $dailyExpense)
    {
        $data = $this->validateData($request);

        $dailyExpense->update($data);

        return redirect()
            ->route('admin.daily-expenses.edit', $dailyExpense)
            ->with('success', 'Daily expense updated successfully.');
    }

    public function destroy(DailyExpense $dailyExpense)
    {
        $dailyExpense->delete();

        return redirect()
            ->route('admin.daily-expenses.index')
            ->with('success', 'Daily expense deleted successfully.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'expense_type_id' => ['required', 'exists:expense_types,id'],
            'description' => ['nullable', 'string', 'max:255'],
            'amount' => ['required', 'numeric', 'min:0'],
        ]);
    }
}

