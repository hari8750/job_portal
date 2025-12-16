@extends('layouts.app') <!-- Agar aapke paas common layout hai -->

@section('title', 'Employer Dashboard')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold mb-6">Welcome, {{ auth()->user()->name }}</h1>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Post a Job</h2>
            <p>Create and post new job listings.</p>
            <a href="{{ route('employer.post_job') }}" class="text-blue-600 hover:underline mt-2 inline-block">Post Job</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Manage Applications</h2>
            <p>Review applications submitted by candidates.</p>
            <a href="{{ route('employer.applications') }}" class="text-blue-600 hover:underline mt-2 inline-block">View Applications</a>
        </div>

        <div class="bg-white shadow rounded p-4">
            <h2 class="text-xl font-semibold mb-2">Company Profile</h2>
            <p>Update your company information and profile.</p>
            <a href="{{ route('employer.profile') }}" class="text-blue-600 hover:underline mt-2 inline-block">Edit Profile</a>
        </div>
    </div>
</div>
@endsection
