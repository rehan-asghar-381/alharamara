@csrf

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="name">Name</label>
            <input
                type="text"
                id="name"
                name="name"
                class="form-control @error('name') is-invalid @enderror"
                value="{{ old('name', $vendor->name ?? '') }}"
                required
            >
            @error('name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="contact_person">Contact Person</label>
            <input
                type="text"
                id="contact_person"
                name="contact_person"
                class="form-control @error('contact_person') is-invalid @enderror"
                value="{{ old('contact_person', $vendor->contact_person ?? '') }}"
            >
            @error('contact_person')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="phone">Phone</label>
            <input
                type="text"
                id="phone"
                name="phone"
                class="form-control @error('phone') is-invalid @enderror"
                value="{{ old('phone', $vendor->phone ?? '') }}"
            >
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                class="form-control @error('email') is-invalid @enderror"
                value="{{ old('email', $vendor->email ?? '') }}"
            >
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="is_active">Status</label>
            <select
                id="is_active"
                name="is_active"
                class="form-control @error('is_active') is-invalid @enderror"
            >
                @php
                    $isActive = old('is_active', isset($vendor) ? (int) $vendor->is_active : 1);
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
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="address">Address</label>
            <textarea
                id="address"
                name="address"
                rows="3"
                class="form-control @error('address') is-invalid @enderror"
            >{{ old('address', $vendor->address ?? '') }}</textarea>
            @error('address')
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

