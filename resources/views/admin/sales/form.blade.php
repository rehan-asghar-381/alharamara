@csrf

<div class="row">
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input
                type="date"
                id="date"
                name="date"
                class="form-control @error('date') is-invalid @enderror"
                value="{{ old('date', optional($sale->date)->format('Y-m-d')) }}"
                required
            >
            @error('date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="customer_name">Customer Name</label>
            <input
                type="text"
                id="customer_name"
                name="customer_name"
                class="form-control @error('customer_name') is-invalid @enderror"
                value="{{ old('customer_name', $sale->customer_name ?? '') }}"
                required
            >
            @error('customer_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="wood_type">Wood Type</label>
            @php
                $selectedWoodType = old('wood_type', $sale->wood_type ?? '');
            @endphp
            <select
                id="wood_type"
                name="wood_type"
                class="form-control @error('wood_type') is-invalid @enderror"
                required
            >
                <option value="" disabled {{ $selectedWoodType === '' ? 'selected' : '' }}>Select Wood Type</option>
                @foreach($woodTypes as $woodType)
                    <option value="{{ $woodType }}" {{ $selectedWoodType === $woodType ? 'selected' : '' }}>
                        {{ $woodType }}
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
            <label for="available_stock">Available Stock</label>
            <input
                type="text"
                id="available_stock"
                class="form-control"
                readonly
            >
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="quantity">Quantity</label>
            <input
                type="number"
                step="0.01"
                id="quantity"
                name="quantity"
                class="form-control @error('quantity') is-invalid @enderror"
                value="{{ old('quantity', $sale->quantity ?? 0) }}"
                required
            >
            @error('quantity')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="unit">Unit</label>
            @php
                $selectedUnit = old('unit', $sale->unit ?? '');
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
</div>

<div class="row">
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label for="unit_price">Unit Price</label>
            <input
                type="number"
                step="0.01"
                id="unit_price"
                name="unit_price"
                class="form-control @error('unit_price') is-invalid @enderror"
                value="{{ old('unit_price', $sale->unit_price ?? 0) }}"
                required
            >
            @error('unit_price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group mb-3">
            <label>Total Price (auto-calculated)</label>
            <input
                type="text"
                id="sale_total_price_display"
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
            var currentAvailable = 0;

            function fetchAvailableStock() {
                var woodType = $('#wood_type').val();
                if (!woodType) {
                    currentAvailable = 0;
                    $('#available_stock').val('');
                    return;
                }

                $.ajax({
                    url: '{{ route('admin.stock.available') }}',
                    method: 'GET',
                    data: { wood_type: woodType },
                    success: function (response) {
                        if (typeof response.available !== 'undefined') {
                            currentAvailable = parseFloat(response.available) || 0;
                            $('#available_stock').val(currentAvailable ? currentAvailable.toFixed(2) : '0.00');
                            validateQuantity();
                        }
                    }
                });
            }

            function recalcSaleTotal() {
                var qty = parseFloat($('#quantity').val()) || 0;
                var unitPrice = parseFloat($('#unit_price').val()) || 0;

                var total = qty * unitPrice;
                if (total < 0) {
                    total = 0;
                }

                $('#sale_total_price_display').val(total ? total.toFixed(2) : '');
            }

            function validateQuantity() {
                var qty = parseFloat($('#quantity').val()) || 0;
                var $qtyInput = $('#quantity');

                if (qty > currentAvailable && currentAvailable > 0) {
                    $qtyInput.addClass('is-invalid');
                    if (!$qtyInput.next('.invalid-feedback').length) {
                        $qtyInput.after('<div class="invalid-feedback">Quantity exceeds available stock.</div>');
                    }
                } else {
                    $qtyInput.removeClass('is-invalid');
                    $qtyInput.next('.invalid-feedback').remove();
                }
            }

            $(document).ready(function () {
                $('#wood_type').on('change', function () {
                    fetchAvailableStock();
                });

                $('#quantity, #unit_price').on('input change', function () {
                    recalcSaleTotal();
                    validateQuantity();
                });

                // Initial state
                fetchAvailableStock();
                recalcSaleTotal();
                validateQuantity();
            });
        })(jQuery);
    </script>
@endpush

