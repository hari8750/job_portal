@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Profile</h3>
    <p class="text-muted">Update your information and profile.</p>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('employer.profile.update') }}" method="POST" enctype="multipart/form-data" class="card p-4 shadow-sm">
        @csrf

        <div class="mb-3">
            <label class="form-label">Name</label>
            <input type="text" name="company_name" class="form-control" 
                   value="{{ old('company_name', $employer->company_name) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Address</label>
            <input type="text" name="address" class="form-control" 
                   value="{{ old('address', $employer->address) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="company_description" class="form-control" rows="4">{{ old('company_description', $employer->company_description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Aadhar Card</label>
            <input type="file" name="aadhar_card" class="form-control">
            @if($employer->aadhar_card)
                <div class="mt-2">
                    <a href="{{ asset('uploads/aadhar/'.$employer->aadhar_card) }}" target="_blank">View Uploaded Aadhar</a>
                </div>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">Save Profile</button>
    </form>
</div>
@endsection
