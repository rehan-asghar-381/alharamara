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
                value="{{ old('date', optional($dailyExpense->date)->format('Y-m-d')) }}"
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
            <label for="expense_type_id">Expense Type</label>
            <select
                id="expense_type_id"
                name="expense_type_id"
                class="form-control @error('expense_type_id') is-invalid @enderror"
                required
            >
                <option value="" disabled {{ old('expense_type_id', $dailyExpense->expense_type_id ?? '') === null ? 'selected' : '' }}>
                    Select Expense Type
                </option>
                @foreach($expenseTypes as $type)
                    <option value="{{ $type->id }}"
                        {{ (string) old('expense_type_id', $dailyExpense->expense_type_id ?? '') === (string) $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
            @error('expense_type_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group mb-3">
            <label for="amount">Amount</label>
            <input
                type="number"
                step="0.01"
                id="amount"
                name="amount"
                class="form-control @error('amount') is-invalid @enderror"
                value="{{ old('amount', $dailyExpense->amount ?? 0) }}"
                required
            >
            @error('amount')
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
            >{{ old('description', $dailyExpense->description ?? '') }}</textarea>
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

