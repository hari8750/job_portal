@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center bg-gray-100 py-12">
    <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">
        <h2 class="text-3xl font-bold text-center text-blue-600 mb-6">Apply for: {{ $job->title }}</h2>

        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-3 rounded mb-4 text-center">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4 text-center">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('apply.job', $job->id) }}" method="POST" class="space-y-4">
            @csrf

            <!-- Name Field -->
            <div class="flex flex-col">
                <label for="name" class="text-gray-700 font-medium mb-1">Full Name</label>
                <input type="text" id="name" name="name" value="{{ auth()->user()->name ?? '' }}" placeholder="Enter your full name"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Phone Field -->
            <div class="flex flex-col">
                <label for="phone" class="text-gray-700 font-medium mb-1">Phone Number</label>
                <input type="text" id="phone" name="phone" value="{{ auth()->user()->phone ?? '' }}" placeholder="Enter phone number"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- City Field -->
            <div class="flex flex-col">
                <label for="city" class="text-gray-700 font-medium mb-1">City</label>
                <input type="text" id="city" name="city" placeholder="Enter your city"
                       class="w-full border border-gray-300 rounded-lg px-4 py-3 focus:ring-2 focus:ring-blue-500 focus:outline-none">
            </div>

            <!-- Submit Button -->
            <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition duration-200">
                Submit Application
            </button>
        </form>
    </div>
</div>
@endsection
