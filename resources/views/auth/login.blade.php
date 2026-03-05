@extends('layouts.master')

@section('title', 'Login')

@section('body-class', 'login-area')

@section('content')
    <div class="main-content- h-100vh">
        <div class="container h-100">
            <div class="row h-100 align-items-center justify-content-center">
                <div class="col-sm-10 col-md-7 col-lg-5">
                    <!-- Middle Box -->
                    <div class="middle-box">
                        <div class="card-body">
                            <div class="log-header-area card p-4 mb-4 text-center">
                                <h5>Welcome Back !</h5>
                                <p class="mb-0">Sign in to continue.</p>
                            </div>

                            <div class="card">
                                <div class="card-body p-4">
                                    @if ($errors->any())
                                        <div class="alert alert-danger mb-3">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('login') }}">
                                        @csrf

                                        <div class="form-group mb-3">
                                            <label class="text-muted" for="email">Email address</label>
                                            <input
                                                class="form-control @error('email') is-invalid @enderror"
                                                type="email"
                                                id="email"
                                                name="email"
                                                value="{{ old('email') }}"
                                                required
                                                autofocus
                                                placeholder="Enter your email">
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <label class="text-muted" for="password">Password</label>
                                            <input
                                                class="form-control @error('password') is-invalid @enderror"
                                                type="password"
                                                id="password"
                                                name="password"
                                                required
                                                placeholder="Enter your password">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>

                                        <div class="form-group mb-3">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="remember"
                                                        id="remember" {{ old('remember') ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="remember">
                                                        Remember me
                                                    </label>
                                                </div>

                                                @if (Route::has('password.request'))
                                                    <a class="small" href="{{ route('password.request') }}">
                                                        Forgot password?
                                                    </a>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="form-group mb-3">
                                            <button class="btn btn-primary btn-lg w-100" type="submit">Sign In</button>
                                        </div>

                                        <div class="text-center">
                                            <span class="me-1">Don't have an account?</span>
                                            @if (Route::has('register'))
                                                <a class="fw-bold" href="{{ route('register') }}">Sign up</a>
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

