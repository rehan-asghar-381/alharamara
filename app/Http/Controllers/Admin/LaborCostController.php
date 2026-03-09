<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LaborCost;
use Illuminate\Http\Request;

class LaborCostController extends Controller
{
    public function index()
    {
        $laborCosts = LaborCost::orderByDesc('date')->paginate(10);

        return view('admin.labor_costs.index', compact('laborCosts'));
    }

    public function create()
    {
        $laborCost = new LaborCost([
            'date' => now()->toDateString(),
        ]);

        return view('admin.labor_costs.create', compact('laborCost'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        $data['total_amount'] = $this->calculateTotal($data['hours'], $data['rate_per_hour']);

        LaborCost::create($data);

        return redirect()
            ->route('admin.labor-costs.index')
            ->with('success', 'Labor cost recorded successfully.');
    }

    public function edit(LaborCost $laborCost)
    {
        return view('admin.labor_costs.edit', compact('laborCost'));
    }

    public function update(Request $request, LaborCost $laborCost)
    {
        $data = $this->validateData($request);

        $data['total_amount'] = $this->calculateTotal($data['hours'], $data['rate_per_hour']);

        $laborCost->update($data);

        return redirect()
            ->route('admin.labor-costs.index')
            ->with('success', 'Labor cost updated successfully.');
    }

    public function destroy(LaborCost $laborCost)
    {
        $laborCost->delete();

        return redirect()
            ->route('admin.labor-costs.index')
            ->with('success', 'Labor cost deleted successfully.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'worker_name' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:255'],
            'hours' => ['required', 'numeric', 'min:0'],
            'rate_per_hour' => ['required', 'numeric', 'min:0'],
        ]);
    }

    protected function calculateTotal($hours, $ratePerHour): float
    {
        $total = (float) $hours * (float) $ratePerHour;

        return max($total, 0);
    }
}

