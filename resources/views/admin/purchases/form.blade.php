@csrf

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="vendor">Vendor</label>
            @php
                $selectedVendor = old('vendor', $purchase->vendor ?? '');
            @endphp
            <select
                id="vendor"
                name="vendor"
                class="form-control @error('vendor') is-invalid @enderror"
                required
            >
                <option value="" disabled {{ $selectedVendor === '' ? 'selected' : '' }}>Select Vendor</option>
                @foreach($vendors as $vendor)
                    <option value="{{ $vendor->name }}" {{ $selectedVendor === $vendor->name ? 'selected' : '' }}>
                        {{ $vendor->name }}
                    </option>
                @endforeach
            </select>
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
            @php
                $selectedWoodType = old('wood_type', $purchase->wood_type ?? '');
            @endphp
            <select
                id="wood_type"
                name="wood_type"
                class="form-control @error('wood_type') is-invalid @enderror"
                required
            >
                <option value="" disabled {{ $selectedWoodType === '' ? 'selected' : '' }}>Select Wood Type</option>
                @foreach($woodTypes as $woodType)
                    <option value="{{ $woodType->name }}" {{ $selectedWoodType === $woodType->name ? 'selected' : '' }}>
                        {{ $woodType->name }}
                    </option>
                @endforeach
            </select>
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
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="unit">Unit</label>
            @php
                $selectedUnit = old('unit', $purchase->unit ?? '');
            @endphp
            <select
                id="unit"
                name="unit"
                class="form-control @error('unit') is-invalid @enderror"
            >
                <option value="" {{ $selectedUnit === '' ? 'selected' : '' }}>Select Unit</option>
                <option value="kg" {{ $selectedUnit === 'kg' ? 'selected' : '' }}>Kg</option>
                <option value="ton" {{ $selectedUnit === 'ton' ? 'selected' : '' }}>Ton</option>
                <option value="cft" {{ $selectedUnit === 'cft' ? 'selected' : '' }}>CFT</option>
                <option value="pcs" {{ $selectedUnit === 'pcs' ? 'selected' : '' }}>Pieces</option>
            </select>
            @error('unit')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
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
</div>

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="purchase_available_stock">Available Stock</label>
            <input
                type="text"
                id="purchase_available_stock"
                class="form-control"
                readonly
            >
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
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
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label>Total Price (auto-calculated)</label>
            <input
                type="text"
                id="total_price_display"
                class="form-control"
                readonly
            >
        </div>
    </div>
</div>

<div class="form-group mb-0">
    <button type="submit" class="btn btn-primary btn-lg">
        {{ $submitLabel }}
    </button>
    </div>

@push('scripts')
    <script>
        (function ($) {
            function recalcTotalPrice() {
                var qty = parseFloat($('#quantity').val()) || 0;
                var unitPrice = parseFloat($('#unit_price').val()) || 0;
                var discount = parseFloat($('#discount').val()) || 0;

                var total = (qty * unitPrice) - discount;
                if (total < 0) {
                    total = 0;
                }

                $('#total_price_display').val(total ? total.toFixed(2) : '');
            }

            function fetchPurchaseAvailableStock() {
                var woodType = $('#wood_type').val();
                if (!woodType) {
                    $('#purchase_available_stock').val('');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.stock.available') }}',
                    method: 'GET',
                    data: { wood_type: woodType },
                    success: function (response) {
                        if (typeof response.available !== 'undefined') {
                            var available = parseFloat(response.available) || 0;
                            $('#purchase_available_stock').val(available ? available.toFixed(2) : '0.00');
                        }
                    }
                });
            }

            $(document).ready(function () {
                $('#quantity, #unit_price, #discount').on('input change', recalcTotalPrice);
                $('#wood_type').on('change', fetchPurchaseAvailableStock);
                recalcTotalPrice();
                fetchPurchaseAvailableStock();
            });
        })(jQuery);
    </script>
@endpush
