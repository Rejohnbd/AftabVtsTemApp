@extends('layouts.login-master')

@section('title', 'Login')

@section('content')
<div class="container-login100">
    <div class="wrap-login100 p-6">
        <form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
            @csrf
            <span class="login100-form-title">
                Member Login
            </span>
            <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="zmdi zmdi-email" aria-hidden="true"></i>
                </span>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
                <span class="focus-input100"></span>
                <span class="symbol-input100">
                    <i class="zmdi zmdi-lock" aria-hidden="true"></i>
                </span>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="text-right pt-1">
                <p class="mb-0"><a href="{{ route('password.request') }}" class="text-primary ml-1">Forgot Password?</a></p>
            </div>
            <div class="container-login100-form-btn">
                <button type="submit" class="login100-form-btn btn-primary">
                    Login
                </button>
            </div>
        </form>
    </div>
</div>
@endsection