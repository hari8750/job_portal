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
        max-width: 1200px; /* 👈 aur bhi chaurai badh gayi */
        border: none;
        border-radius: 15px;
        box-shadow: 0px 10px 25px rgba(0, 0, 0, 0.2);
        background: #fff;
        padding: 15px 20px; /* 👈 andar ka space kam kiya, height ghat gayi */
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
        border-radius: 8px;
        padding: 8px;  /* 👈 kam height */
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
    .login-link {
        text-align: center;
        margin-top: 10px;
        font-size: 0.9rem;
    }
    .login-link a {
        color: #667eea;
        font-weight: bold;
        text-decoration: none;
    }
    .login-link a:hover {
        text-decoration: underline;
    }
</style>

<div class="card">
    <div class="card-header">{{ __('Register') }}</div>

    <div class="card-body">
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">{{ __('Name') }}</label>
                <input id="name" type="text"
                    class="form-control @error('name') is-invalid @enderror"
                    name="name" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback"><strong>{{ $message }}</strong></span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">{{ __('Email Address') }}</label>
                <input id="email" type="email"
                    class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required>
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
                    class="form-control"
                    name="password_confirmation" required>
            </div>

            <!-- ✅ New Role Dropdown Added -->
            <div class="mb-3">
                <label for="role" class="form-label">Register As</label>
                <select id="role" name="role" class="form-control" required>
                    <option value="candidate">Candidate</option>
                    <option value="employer">Employer</option>
                </select>
            </div>
            <!-- End Role Dropdown -->

            <div class="d-grid">
                <button type="submit" class="btn btn-primary">
                    {{ __('Register') }}
                </button>
            </div>

            <div class="login-link">
                Already have an account?
                <a href="{{ route('login') }}">Login here</a>
            </div>
        </form>
    </div>
</div>
@endsection
