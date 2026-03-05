@csrf

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="vendor">Vendor</label>
            <input type="text"
                   id="vendor"
                   name="vendor"
                   class="form-control @error('vendor') is-invalid @enderror"
                   value="{{ old('vendor', $purchase->vendor ?? '') }}"
                   required>
            @error('vendor')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="wood_type">Wood Type</label>
            <input type="text"
                   id="wood_type"
                   name="wood_type"
                   class="form-control @error('wood_type') is-invalid @enderror"
                   value="{{ old('wood_type', $purchase->wood_type ?? '') }}"
                   required>
            @error('wood_type')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="quantity">Quantity</label>
            <input type="number"
                   step="0.01"
                   id="quantity"
                   name="quantity"
                   class="form-control @error('quantity') is-invalid @enderror"
                   value="{{ old('quantity', $purchase->quantity ?? '') }}"
                   required>
            @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="unit_price">Unit Price</label>
            <input type="number"
                   step="0.01"
                   id="unit_price"
                   name="unit_price"
                   class="form-control @error('unit_price') is-invalid @enderror"
                   value="{{ old('unit_price', $purchase->unit_price ?? '') }}"
                   required>
            @error('unit_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="discount">Discount</label>
            <input type="number"
                   step="0.01"
                   id="discount"
                   name="discount"
                   class="form-control @error('discount') is-invalid @enderror"
                   value="{{ old('discount', $purchase->discount ?? 0) }}">
            @error('discount')
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
            <label for="paid_amount">Paid Amount</label>
            <input type="number"
                   step="0.01"
                   id="paid_amount"
                   name="paid_amount"
                   class="form-control @error('paid_amount') is-invalid @enderror"
                   value="{{ old('paid_amount', $purchase->paid_amount ?? 0) }}"
                   required>
            @error('paid_amount')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label>Total Price (auto-calculated)</label>
            <input type="text"
                   class="form-control"
                   value="{{ old('quantity', $purchase->quantity ?? 0) && old('unit_price', $purchase->unit_price ?? 0)
                        ? number_format((old('quantity', $purchase->quantity ?? 0) * old('unit_price', $purchase->unit_price ?? 0)) - old('discount', $purchase->discount ?? 0), 2)
                        : '' }}"
                   readonly>
        </div>
    </div>
</div>

<div class="form-group mb-0">
    <button type="submit" class="btn btn-primary btn-lg w-100">
        {{ $submitLabel }}
    </button>
</div>

