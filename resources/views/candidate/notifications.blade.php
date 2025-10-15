@extends('layouts.app')

@section('content')
<div class="container mx-auto p-4 max-w-lg bg-white shadow rounded">
    <h2 class="text-2xl font-bold mb-4">Notifications</h2>

    @if($notifications->isEmpty())
        <p class="text-gray-600">No notifications yet.</p>
    @else
        <ul>
            @foreach($notifications as $notification)
                <li class="border p-2 mb-2 rounded flex justify-between items-center">
                    <span>{{ $notification->data['message'] ?? $notification->type }}</span>
                    <span class="text-gray-500 text-sm">{{ $notification->created_at->diffForHumans() }}</span>
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
