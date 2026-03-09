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
                value="{{ old('date', optional($laborCost->date)->format('Y-m-d')) }}"
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
            <label for="worker_name">Worker Name</label>
            <input
                type="text"
                id="worker_name"
                name="worker_name"
                class="form-control @error('worker_name') is-invalid @enderror"
                value="{{ old('worker_name', $laborCost->worker_name ?? '') }}"
            >
            @error('worker_name')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="description">Description</label>
            <input
                type="text"
                id="description"
                name="description"
                class="form-control @error('description') is-invalid @enderror"
                value="{{ old('description', $laborCost->description ?? '') }}"
            >
            @error('description')
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
            <label for="hours">Working Days</label>
            <input
                type="number"
                step="0.01"
                id="hours"
                name="hours"
                class="form-control @error('hours') is-invalid @enderror"
                value="{{ old('hours', $laborCost->hours ?? 0) }}"
                required
            >
            @error('hours')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="rate_per_hour">Rate per Day</label>
            <input
                type="number"
                step="0.01"
                id="rate_per_hour"
                name="rate_per_hour"
                class="form-control @error('rate_per_hour') is-invalid @enderror"
                value="{{ old('rate_per_hour', $laborCost->rate_per_hour ?? 0) }}"
                required
            >
            @error('rate_per_hour')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label>Total Amount (auto-calculated)</label>
            <input
                type="text"
                id="total_amount_display"
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
            function recalcLaborTotal() {
                var days = parseFloat($('#hours').val()) || 0;
                var rate = parseFloat($('#rate_per_hour').val()) || 0;

                var total = days * rate;
                if (total < 0) {
                    total = 0;
                }

                $('#total_amount_display').val(total ? total.toFixed(2) : '');
            }

            $(document).ready(function () {
                $('#hours, #rate_per_hour').on('input change', recalcLaborTotal);
                recalcLaborTotal();
            });
        })(jQuery);
    </script>
@endpush

