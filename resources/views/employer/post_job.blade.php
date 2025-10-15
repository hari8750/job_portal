@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Post a New Job</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('employer.postjob.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Job Title</label>
            <input type="text" name="title" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="company" class="form-label">Company Name</label>
            <input type="text" name="company" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Job Description</label>
            <textarea name="description" class="form-control" rows="4" required></textarea>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" name="location" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="salary" class="form-label">Salary (Optional)</label>
            <input type="text" name="salary" class="form-control">
        </div>

        <div class="mb-3">
            <label for="type" class="form-label">Job Type</label>
            <select name="type" class="form-control" required>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
                <option value="Internship">Internship</option>
                <option value="Remote">Remote</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Post Job</button>
    </form>
</div>
@endsection
