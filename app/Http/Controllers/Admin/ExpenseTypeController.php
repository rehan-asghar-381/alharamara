<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ExpenseType;
use Illuminate\Http\Request;

class ExpenseTypeController extends Controller
{
    public function index()
    {
        $expenseTypes = ExpenseType::orderBy('name')->paginate(10);

        return view('admin.expense_types.index', compact('expenseTypes'));
    }

    public function create()
    {
        $expenseType = new ExpenseType();

        return view('admin.expense_types.create', compact('expenseType'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        ExpenseType::create($data);

        return redirect()
            ->route('admin.expense-types.index')
            ->with('success', 'Expense type created successfully.');
    }

    public function edit(ExpenseType $expenseType)
    {
        return view('admin.expense_types.edit', compact('expenseType'));
    }

    public function update(Request $request, ExpenseType $expenseType)
    {
        $data = $this->validateData($request, $expenseType->id);

        $expenseType->update($data);

        return redirect()
            ->route('admin.expense-types.index')
            ->with('success', 'Expense type updated successfully.');
    }

    public function destroy(ExpenseType $expenseType)
    {
        $expenseType->delete();

        return redirect()
            ->route('admin.expense-types.index')
            ->with('success', 'Expense type deleted successfully.');
    }

    protected function validateData(Request $request, ?int $id = null): array
    {
        $uniqueNameRule = 'unique:expense_types,name';

        if ($id) {
            $uniqueNameRule .= ',' . $id;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255', $uniqueNameRule],
            'description' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}

