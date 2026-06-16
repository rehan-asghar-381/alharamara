<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WoodType;
use Illuminate\Http\Request;

class WoodTypeController extends Controller
{
    public function index()
    {
        $woodTypes = WoodType::orderBy('name')->paginate(10);

        return view('admin.wood_types.index', compact('woodTypes'));
    }

    public function create()
    {
        $woodType = new WoodType();

        return view('admin.wood_types.create', compact('woodType'));
    }

    public function store(Request $request)
    {
        $data = $this->validateData($request);

        WoodType::create($data);

        return redirect()
            ->route('admin.wood-types.create')
            ->with('success', 'Wood type created successfully.');
    }

    public function edit(WoodType $woodType)
    {
        return view('admin.wood_types.edit', compact('woodType'));
    }

    public function update(Request $request, WoodType $woodType)
    {
        $data = $this->validateData($request, $woodType->id);

        $woodType->update($data);

        return redirect()
            ->route('admin.wood-types.edit', $woodType)
            ->with('success', 'Wood type updated successfully.');
    }

    public function destroy(WoodType $woodType)
    {
        $woodType->delete();

        return redirect()
            ->route('admin.wood-types.index')
            ->with('success', 'Wood type deleted successfully.');
    }

    protected function validateData(Request $request, ?int $id = null): array
    {
        $uniqueRule = 'unique:wood_types,name';

        if ($id) {
            $uniqueRule .= ',' . $id;
        }

        return $request->validate([
            'name' => ['required', 'string', 'max:255', $uniqueRule],
            'description' => ['nullable', 'string'],
            'default_sale_price' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['sometimes', 'boolean'],
        ]);
    }
}

