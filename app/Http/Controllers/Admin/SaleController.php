<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\WoodType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleController extends Controller
{
    public function index()
    {
        $sales = Sale::orderByDesc('date')->paginate(10);

        return view('admin.sales.index', compact('sales'));
    }

    public function create()
    {
        $woodTypes = WoodType::where('is_active', true)
            ->orderBy('name')
            ->pluck('name');

        $sale = new Sale([
            'date' => now()->toDateString(),
        ]);

        return view('admin.sales.create', compact('sale', 'woodTypes'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);
        $data['customer_name'] = 'Walk-in Customer';

        $available = $this->getAvailableStock($data['wood_type']);
        if ($data['quantity'] > $available) {
            return back()
                ->withErrors([
                    'quantity' => 'Not enough stock available. Available: ' . number_format($available, 2),
                ])
                ->withInput();
        }

        $data['total_price'] = $this->calculateTotal($data['quantity'], $data['unit_price']);

        Sale::create($data);

        return redirect()
            ->route('admin.sales.create')
            ->with('success', 'Sale recorded successfully.');
    }

    public function edit(Sale $sale)
    {
        $woodTypes = WoodType::where('is_active', true)
            ->orderBy('name')
            ->pluck('name');

        return view('admin.sales.edit', compact('sale', 'woodTypes'));
    }

    public function update(Request $request, Sale $sale)
    {
        $data = $this->validateData($request);
        $data['customer_name'] = $sale->customer_name ?: 'Walk-in Customer';

        $available = $this->getAvailableStock($data['wood_type'], $sale);
        if ($data['quantity'] > $available) {
            return back()
                ->withErrors([
                    'quantity' => 'Not enough stock available. Available: ' . number_format($available, 2),
                ])
                ->withInput();
        }

        $data['total_price'] = $this->calculateTotal($data['quantity'], $data['unit_price']);

        $sale->update($data);

        return redirect()
            ->route('admin.sales.edit', $sale)
            ->with('success', 'Sale updated successfully.');
    }

    public function destroy(Sale $sale)
    {
        $sale->delete();

        return redirect()
            ->route('admin.sales.index')
            ->with('success', 'Sale deleted successfully.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'date' => ['required', 'date'],
            'wood_type' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'min:0.01'],
            'unit' => ['nullable', 'string', 'max:50'],
            'unit_price' => ['required', 'numeric', 'min:0'],
        ]);
    }

    protected function calculateTotal($quantity, $unitPrice): float
    {
        $total = (float) $quantity * (float) $unitPrice;

        return max($total, 0);
    }

    protected function getAvailableStock(string $woodType, ?Sale $excludeSale = null): float
    {
        $purchased = Purchase::where('wood_type', $woodType)->sum('quantity');

        $soldQuery = Sale::where('wood_type', $woodType);
        if ($excludeSale) {
            $soldQuery->where('id', '!=', $excludeSale->id);
        }
        $sold = $soldQuery->sum('quantity');

        $available = (float) $purchased - (float) $sold;

        return max($available, 0);
    }

    public function availableStock(Request $request)
    {
        $data = $request->validate([
            'wood_type' => ['required', 'string', 'max:255'],
        ]);

        $available = $this->getAvailableStock($data['wood_type']);
        $woodType = WoodType::where('name', $data['wood_type'])->first();

        return response()->json([
            'available' => $available,
            'default_sale_price' => (float) ($woodType->default_sale_price ?? 0),
        ]);
    }
}

