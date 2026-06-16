@csrf

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $woodType->name ?? '') }}"
                required
            >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="default_sale_price">Default Sale Price</label>
            <input
                type="number"
                step="0.01"
                id="default_sale_price"
                name="default_sale_price"
                class="form-control @error('default_sale_price') is-invalid @enderror"
                value="{{ old('default_sale_price', $woodType->default_sale_price ?? '') }}"
            >
            @error('default_sale_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="is_active">Status</label>
            <select
                id="is_active"
                name="is_active"
                class="form-control @error('is_active') is-invalid @enderror"
            >
                @php
                    $isActive = old('is_active', isset($woodType) ? (int) $woodType->is_active : 1);
                @endphp
                <option value="1" {{ $isActive === 1 ? 'selected' : '' }}>Active</option>
                <option value="0" {{ $isActive === 0 ? 'selected' : '' }}>Inactive</option>
            </select>
            @error('is_active')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <textarea
                id="description"
                name="description"
                rows="3"
                class="form-control @error('description') is-invalid @enderror"
            >{{ old('description', $woodType->description ?? '') }}</textarea>
            @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="form-group mb-0">
    <button type="submit" class="btn btn-primary btn-lg">
        {{ $submitLabel }}
    </button>
</div>

