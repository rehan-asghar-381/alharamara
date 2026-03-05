@csrf

<div class="form-group mb-3">
    <label for="name">Name</label>
    <input type="text"
           id="name"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $role->name ?? '') }}"
           required>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="permissions">Permissions</label>
    <select id="permissions"
            name="permissions[]"
            class="form-control"
            multiple>
        @foreach ($permissions as $permission)
            <option value="{{ $permission->name }}"
                @if (!empty($rolePermissionNames) && in_array($permission->name, $rolePermissionNames)) selected @endif>
                {{ $permission->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-0">
    <button type="submit" class="btn btn-primary btn-lg w-100">
        {{ $submitLabel }}
    </button>
</div>

