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
        max-width: 1000px; /* 👈 width zyada */
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
    }
    .btn-primary:hover {
        background: linear-gradient(135deg, #764ba2, #667eea);
        transform: scale(1.05);
    }
    .forgot-link {
        margin-top: 10px;
        display: block;
        text-align: right;
        font-size: 0.9rem;
    }
    .forgot-link a {
        color: #667eea;
        text-decoration: none;
        font-weight: bold;
    }
    .forgot-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="card">
    <div class="card-header">{{ __('Login') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autofocus>
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

            <div class="mb-3 form-check">
                <input class="form-check-input" type="checkbox"
                    name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember">
                    {{ __('Remember Me') }}
                </label>
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    {{ __('Login') }}
                </button>
            </div>

            @if (Route::has('password.request'))
                <div class="forgot-link">
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
