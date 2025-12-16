@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #4facfe, #00f2fe);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        font-family: 'Poppins', sans-serif;
    }
    .card {
        width: 100%;
        max-width: 800px;
        border: none;
        border-radius: 15px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        background: #fff;
        padding: 20px 30px;
    }
    .card-header {
        font-size: 1.8rem;
        font-weight: bold;
        text-align: center;
        background: linear-gradient(135deg, #667eea, #764ba2);
        color: white;
        border-radius: 15px 15px 0 0;
        padding: 15px;
        letter-spacing: 1px;
    }
    .form-control {
        border-radius: 10px;
        padding: 10px;
        transition: 0.3s;
    }
    .form-control:focus {
        border-color: #667eea;
        box-shadow: 0 0 10px rgba(102, 126, 234, 0.6);
    }
    .btn-primary {
        background: linear-gradient(135deg, #667eea, #764ba2);
        border: none;
        border-radius: 10px;
        padding: 10px;
        font-size: 1.1rem;
        transition: 0.3s;
        width: 100%;
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #764ba2, #667eea);
        transform: scale(1.05);
    }
</style>

<div class="card">
    <div class="card-header">{{ __('Reset Password') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                       class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ $email ?? old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">{{ __('Password') }}</label>
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required>
                @error('password')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password-confirm" class="form-label">{{ __('Confirm Password') }}</label>
                <input id="password-confirm" type="password"
                       class="form-control" name="password_confirmation" required>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
