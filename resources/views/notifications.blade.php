@extends('layout')
@section('title', 'Notifications')
@section('content')
<div class="container">
    <h1>Notifications</h1>
    <div class="list-group">
        @forelse ($notifications as $notification)
        <a href="{{ route('notifications.markAsRead', [ 'notification' => $notification->id]) }}" class="list-group-item list-group-item-action" aria-current="true">
            <div class="d-flex w-100 justify-content-between">
                <h5 class="mb-1">{{ $notification->message }}</h5>
                <small>{{ $notification->created_at->diffForHumans() }}</small>
            </div>
            <p class="mb-1">{{ $notification->type }}</p>
            @if (!$notification->read)
            <small style="color: rgb(74, 230, 74)">New</small>
            @endif
        </a>
        @empty
        <p class="text-center">No notifications found.</p>
        @endforelse
    </div>
</div>
@endsection

