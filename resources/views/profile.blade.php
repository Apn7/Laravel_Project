@extends('layout')
@section('title', 'Profile Page')
@section('content')

    {{-- user profile page --}}
    <div class="container text-center">
        <h1 class="mt-5">User
            Profile: {{ $user->username }}</h1>
    </div>
    <div class="container text-center">
        <img src="{{ asset('storage/users_dp/user_dp.jpg')}}" class="rounded-circle img-fluid"
            alt="User Profile Picture" style="width: 200px; height: 200px;">
    </div>
    <div class="container text-center">
        <h3 class="mt-3">Email: {{ $user->email }}</h3>
    </div>
    <div class="container text-center">
        <h3 class="mt-3">Username: {{ $user->username }}</h3>
    </div>
    <div class="container text-center">
        <h3 class="mt-3">Bio: {{ $user->bio }}</h3>
    </div>
    <div class="container text-center">
        <h3 class="mt-3">Member Since: {{ $user->created_at }}</h3>
    </div>
    <div class="container text-center">
        <h3 class="mt-3">Total Memes Uploaded: {{ $memes->count() }}</h3>
    </div>
    {{-- <div class="container text-center">
        <h3 class="mt-3">Total Likes Received: {{ $user->likes->count() }}</h3>
    </div> --}}

    {{-- <div>
        @if ($memes)
            @foreach ($memes as $meme)
                <div class="container text-center">
                    <img src="{{ asset('storage/' . $meme->imgurl) }}" class="img-fluid" style="max-width: 100%; height: auto;" alt="Meme Image">
                    <h3 class="mt-3">{{ $meme->description }}</h3>
                </div>
            @endforeach
        @else
            <p>No memes found for this user.</p>
        @endif
    </div> --}}

    @include('show_memes')

    <div class="container">
        <div class="mt-5 text-center">
            {{ $memes->onEachSide(1)->links() }}
        </div>
    </div>


    {{-- @if (Auth::id() == $user->id)
        <div class="container text-center">
            <a href="{{ route('editProfile') }}" class="btn btn-primary mt-3">Edit Profile</a>
        </div>
    @endif --}}
@endsection
