@extends('layouts.employer')

@section('content')
<h3>{{ $job->title }} - Applied Candidates</h3>
<p>Total Applied: {{ $applications->count() }}</p>

@foreach($applications as $application)
<div class="candidate-card border p-3 mb-3 rounded">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h5>{{ $application->name }}</h5>
            <p>Phone: {{ $application->phone }}</p>
            <p>City: {{ $application->city }}</p>
        </div>
        <div>
            <p>Applied: {{ \Carbon\Carbon::parse($application->created_at)->diffForHumans() }}</p>
            <p>Status: {{ ucfirst($application->status) }}</p>

            @if($application->status == 'applied')
                <a href="{{ route('employer.updateStatus', ['id'=>$application->id, 'status'=>'shortlisted']) }}" class="btn btn-sm btn-success">Shortlist</a>
                <a href="{{ route('employer.updateStatus', ['id'=>$application->id, 'status'=>'rejected']) }}" class="btn btn-sm btn-danger">Reject</a>
            @elseif($application->status == 'shortlisted')
                <a href="{{ route('employer.updateStatus', ['id'=>$application->id, 'status'=>'hired']) }}" class="btn btn-sm btn-primary">Hire</a>
                <a href="{{ route('employer.updateStatus', ['id'=>$application->id, 'status'=>'rejected']) }}" class="btn btn-sm btn-danger">Reject</a>
            @endif
        </div>
    </div>
</div>
@endforeach
@endsection
