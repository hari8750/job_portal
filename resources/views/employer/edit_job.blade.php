@extends('layouts.employer')

@section('content')
<div class="container py-4">
    <h3>Edit Job</h3>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('jobs.update', $job->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Job Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Company</label>
            <input type="text" name="company" class="form-control" value="{{ old('company', $job->company) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Location</label>
            <input type="text" name="location" class="form-control" value="{{ old('location', $job->location) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Salary</label>
            <input type="text" name="salary" class="form-control" value="{{ old('salary', $job->salary) }}">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ old('description', $job->description) }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update Job</button>
        <a href="{{ route('employer.dashboard') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
