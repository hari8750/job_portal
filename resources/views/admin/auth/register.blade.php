@extends('admin.layouts.app')

@section('content')
<h2>Admin Register</h2>

@if ($errors->any())
    <div class="error">
        @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
        @endforeach
    </div>
@endif

<form method="POST" action="{{ route('admin.register.submit') }}">
    @csrf
    <input type="text" name="name" placeholder="Full Name" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
    <button type="submit">Register</button>
</form>

<p class="text-center">Already have an account? <a href="{{ route('admin.login') }}">Login here</a></p>
@endsection
