@extends('layouts.app') <!-- Agar aapke paas common layout hai -->

@section('title', 'Candidate Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold mb-2">My Profile</h2>
            <p>View and update your profile details.</p>
            <a href="{{ route('candidate.profile') }}" class="text-blue-600 hover:underline mt-2 inline-block">Go to Profile</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Applied Jobs</h2>
            <p>Check all the jobs you have applied for.</p>
            <a href="{{ route('candidate.jobs') }}" class="text-blue-600 hover:underline mt-2 inline-block">View Jobs</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Notifications</h2>
            <p>See all notifications related to your applications.</p>
            <a href="{{ route('candidate.notifications') }}" class="text-blue-600 hover:underline mt-2 inline-block">View Notifications</a>
        </div>
    </div>
</div>
@endsection
