@extends('layouts.login-master')

@section('title', 'Reset Password')

@section('content')
<div class="container-login100">
    <div class="wrap-login100 p-6">
        <div class="col col-login mx-auto">
            @if (session('status'))
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
            @endif
            <form class="" method="#" action="#">
                {{-- <form class="" method="POST" action="{{ route('password.email') }}"> --}}
                @csrf
                <div class="">
                    <h3 class="text-center card-title">Forgot password</h3>
                    <div class="wrap-input100 validate-input" data-validate="Valid email is required: ex@abc.xyz">
                        <input class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                    <div class="form-footer">
                        <button type="submit" class="btn btn-primary btn-block">Send Password Reset Link</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection