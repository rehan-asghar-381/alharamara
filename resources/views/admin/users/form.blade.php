@csrf

<div class="form-group mb-3">
    <label for="name">Name</label>
    <input type="text"
           id="name"
           name="name"
           class="form-control @error('name') is-invalid @enderror"
           value="{{ old('name', $user->name ?? '') }}"
           required>
    @error('name')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="email">Email</label>
    <input type="email"
           id="email"
           name="email"
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $user->email ?? '') }}"
           required>
    @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="password">Password</label>
    <input type="password"
           id="password"
           name="password"
           class="form-control @error('password') is-invalid @enderror"
           {{ isset($user) ? '' : 'required' }}>
    @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="form-group mb-3">
    <label for="password_confirmation">Confirm Password</label>
    <input type="password"
           id="password_confirmation"
           name="password_confirmation"
           class="form-control">
</div>

<div class="form-group mb-3">
    <label for="roles">Roles</label>
    <select id="roles"
            name="roles[]"
            class="form-control"
            multiple>
        @foreach ($roles as $role)
            <option value="{{ $role->name }}"
                @if (!empty($userRoleNames) && in_array($role->name, $userRoleNames)) selected @endif>
                {{ $role->name }}
            </option>
        @endforeach
    </select>
</div>

<div class="form-group mb-0">
    <button type="submit" class="btn btn-primary btn-lg w-100">
        {{ $submitLabel }}
    </button>
</div>

