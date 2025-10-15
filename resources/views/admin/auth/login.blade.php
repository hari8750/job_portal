@extends('admin.layouts.app')

@section('content')
<h2>Admin Login</h2>

@if ($errors->any())
    <div class="error">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>

<p class="text-center">Don’t have an account? <a href="{{ route('admin.register') }}">Register here</a></p>
@endsection
