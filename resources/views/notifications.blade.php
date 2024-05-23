@extends('layout')
@section('title', 'Notifications')
@section('content')
<div class="container mt-5 notification-container">
    <h1 class="text-center mb-4 notification-title">Notifications</h1>
    <div class="list-group">
        @forelse ($notifications as $notification)
        <a href="{{ route('notifications.markAsRead', [ 'notification' => $notification->id]) }}" class="list-group-item list-group-item-action notification-item" aria-current="true">
            <div class="d-flex w-100 justify-content-between align-items-center notification-content">
                <div class="me-auto">
                    <h5 class="mb-1 notification-message">{{ $notification->message }}</h5>
                    <p class="mb-1 text-muted notification-type">{{ $notification->type }}</p>
                </div>
                <div>
                    <small class="text-muted notification-time">{{ $notification->created_at->diffForHumans() }}</small>
                    @if (!$notification->read)
                    <span class="badge bg-success ms-2 notification-badge">New</span>
                    @endif
                </div>
            </div>
        </a>
        @empty
        <p class="text-center notification-empty">No notifications found.</p>
        @endforelse
        <div class="mt-5 text-center">
            {{ $notifications->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
