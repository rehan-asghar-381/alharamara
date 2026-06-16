<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use App\Models\WoodType;
use App\Models\Purchase;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function index()
    {
        $purchases = Purchase::latest()->paginate(10);

        return view('admin.purchases.index', compact('purchases'));
    }

    public function create()
    {
        $vendors = Vendor::where('is_active', true)
            ->orderBy('name')
            ->get();

        $woodTypes = WoodType::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.purchases.create', compact('vendors', 'woodTypes'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateData($request);

        $validated['total_price'] = $this->calculateTotal(
            $validated['quantity'],
            $validated['unit_price'],
            $validated['discount'] ?? 0
        );

        Purchase::create($validated);

        return redirect()
            ->route('admin.purchases.create')
            ->with('success', 'Purchase recorded successfully.');
    }

    public function edit(Purchase $purchase)
    {
        $vendors = Vendor::where('is_active', true)
            ->orderBy('name')
            ->get();

        $woodTypes = WoodType::where('is_active', true)
            ->orderBy('name')
            ->get();

        return view('admin.purchases.edit', compact('purchase', 'vendors', 'woodTypes'));
    }

    public function update(Request $request, Purchase $purchase)
    {
        $validated = $this->validateData($request);

        $validated['total_price'] = $this->calculateTotal(
            $validated['quantity'],
            $validated['unit_price'],
            $validated['discount'] ?? 0
        );

        $purchase->update($validated);

        return redirect()
            ->route('admin.purchases.edit', $purchase)
            ->with('success', 'Purchase updated successfully.');
    }

    public function destroy(Purchase $purchase)
    {
        $purchase->delete();

        return redirect()
            ->route('admin.purchases.index')
            ->with('success', 'Purchase deleted successfully.');
    }

    protected function validateData(Request $request): array
    {
        return $request->validate([
            'vendor' => ['required', 'string', 'max:255'],
            'wood_type' => ['required', 'string', 'max:255'],
            'quantity' => ['required', 'numeric', 'min:0.01'],
            'unit' => ['nullable', 'string', 'max:50'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'paid_amount' => ['required', 'numeric', 'min:0'],
        ]);
    }

    protected function calculateTotal($quantity, $unitPrice, $discount): float
    {
        $total = ((float) $quantity * (float) $unitPrice) - (float) $discount;

        return max($total, 0);
    }
}

