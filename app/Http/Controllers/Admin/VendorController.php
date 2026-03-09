<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index()
    {
        $vendors = Vendor::orderBy('name')->paginate(10);

        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        $vendor = new Vendor();

        return view('admin.vendors.create', compact('vendor'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        Vendor::create($data);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor created successfully.');
    }

    public function edit(Vendor $vendor)
    {
        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, Vendor $vendor)
    {
        $data = $this->validateData($request, $vendor->id);

        $vendor->update($data);

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor updated successfully.');
    }

    public function destroy(Vendor $vendor)
    {
        $vendor->delete();

        return redirect()
            ->route('admin.vendors.index')
            ->with('success', 'Vendor deleted successfully.');
    }

    protected function validateData(Request $request, ?int $id = null): array
    {
        $uniqueNameRule = 'unique:vendors,name';

        if ($id) {
            $uniqueNameRule .= ',' . $id;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255', $uniqueNameRule],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}

