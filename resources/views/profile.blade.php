@extends('layout')
@section('title', 'Profile Page')
@section('content')

    {{-- user profile page --}}
    <div class="container text-center">
        <h1 class="mt-5">User
            Profile: {{ $user->username }}</h1>
    </div>

    <div class="container text-center">
        @if ($user->avatar)
            <img src="{{ asset('storage/' . $user->avatar) }}" class="rounded-circle img-fluid" alt="User Profile Picture"
                style="width: 200px; height: 200px;">
        @else
            <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                class="rounded-circle img-fluid" alt="User Profile Picture" style="width: 200px; height: 200px;">
        @endif
    </div>

    @auth
    {{-- upload image --}}
    @if (Auth::id() == $user->id)
        <div class="container">
            <form action="{{ route('uploaddp') }}" method="post" enctype="multipart/form-data" class="ms-auto me-auto mt-3"
                style="width: 500px">
                @csrf
                <div class="form-group">
                    <label for="image">Upload a DP</label>
                    <input type="file" class="form-control" id="avatar" name="avatar" required>
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    @endif
    @if (Auth::id() != $user->id)
        <div class="container text-center">
            <form action="{{ route('follow') }}" method="post">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button type="submit"
                    class="btn btn-{{ Auth::user()->following->contains($user->id) ? 'danger' : 'primary' }} mt-3">
                    {{ Auth::user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                </button>
            </form>
        </div>
    @endif
    @endauth
    <div class="container text-center">
        <h3 class="mt-3">Name: {{ $user->name }}</h3>
    </div>

    <div class="container text-center">
        <h3 class="mt-3">Username: {{ $user->username }}</h3>
    </div>

    <div class="container text-center">
        <h3 class="mt-3">Email: {{ $user->email }}</h3>
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

    {{-- user details edit button --}}

    @if (Auth::id() == $user->id)
        <div class="container text-center">
            <form method="get" action="{{ route('editProfileView', ['username' => $user->username]) }}">
                @csrf
                <button type="submit" class="btn btn-primary mt-3">Edit Profile</button>
            </form>
        </div>
        <div class="container text-center mt-3">
            <div class="d-flex justify-content-center"> <!-- Center horizontally -->
                <form class="align-items-center" action="{{ route('search_users') }}" method="get" style="max-width: 500px">
                    <div class="input-group">
                        <input class="form-control border-1 rounded-start me-2" type="text" placeholder="Search Users..."
                            name="query">
                        <button class="btn btn-outline-success rounded-end" type="submit">Search</button>
                    </div>
                </form>
            </div>
        </div>
    @endif



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
