@extends('layouts.app')

@section('content')
<div class="container">
    <h2>My Applied Jobs</h2>

    @if($jobs->count() > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Job Title</th>
                    <th>Status</th>
                    <th>Applied On</th>
                </tr>
            </thead>
            <tbody>
                @foreach($jobs as $application)
                    <tr>
                        <td>{{ $application->job->title ?? 'N/A' }}</td>
                        <td>{{ ucfirst($application->status) }}</td>
                        <td>{{ $application->created_at->format('d M, Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>You haven’t applied for any jobs yet.</p>
    @endif
</div>
@endsection
