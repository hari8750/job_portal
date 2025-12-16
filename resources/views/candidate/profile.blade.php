@extends('layouts.app')

@section('title', 'My Profile')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h2 class="text-2xl font-bold mb-4">👤 My Profile</h2>

    <form action="{{ route('candidate.profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-sm font-medium">Full Name</label>
            <input type="text" name="name" value="{{ Auth::user()->name }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Phone</label>
            <input type="text" name="phone" value="{{ Auth::user()->phone ?? '' }}"
                   class="w-full border rounded-lg px-4 py-2">
        </div>

        <div class="mb-4">
            <label class="block text-sm font-medium">Upload Resume</label>
            <input type="file" name="resume" class="w-full border rounded-lg px-4 py-2">
        </div>

        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
            Save Changes
        </button>
    </form>
</div>
@endsection
