@extends('layout')
@section('title', 'Profile Page')
@section('content')
    <div class="container profile-page follower">
        <div class="row">
            <div class="col-md-4 text-center scrollable-container">
                @if (Auth::id() == $user->id)
                    <div class="search-users mt-2 mb-5">
                        <form action="{{ route('search_users') }}" method="get">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search Users..." name="query">
                                <button class="btn btn-outline-success" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                @endif

                <div class="card profile-card">
                    <div class="card-body text-center">
                        <img src="{{ $user->avatar ? asset('storage/' . $user->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) . '&background=random' }}"
                            class="rounded-circle img-fluid mb-4 profile-img" alt="User Profile Picture">

                        @if (Auth::id() == $user->id)
                            <form action="{{ route('uploaddp') }}" method="post" enctype="multipart/form-data"
                                class="upload-dp-form mb-3">
                                @csrf
                                <input type="file" class="form-control" id="avatar" name="avatar" required>
                                <button type="submit" class="btn btn-upload mt-2">Upload New DP</button>
                            </form>
                        @endif
                        @if (Auth::id() != $user->id)
                        @auth
                        <form action="{{ route('follow') }}" method="post" class="mb-3">
                            @csrf
                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                            <button type="submit"
                                class="btn {{ Auth::user()->following->contains($user->id) ? 'btn-danger' : 'btn-primary' }}">
                                {{ Auth::user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                            </button>
                        </form>
                        @endauth
                        @endif

                        <div class="profile-details text-start">
                            <p><strong>Name:</strong> {{ $user->name }}</p>
                            <p><strong>Username:</strong> {{ $user->username }}</p>
                            <p><strong>Email:</strong> {{ $user->email }}</p>
                            <p><strong>Bio:</strong> {{ $user->bio }}</p>
                            <p><strong>Member Since:</strong> {{ $user->created_at->format('F Y') }}</p>
                            <p><strong>Total Memes Uploaded:</strong> {{ $memes->count() }}</p>
                        </div>

                        <a href="#" data-bs-toggle="modal" data-bs-target="#followersModal"
                            class="followers-link">Followers</a>

                        <!-- Followers Modal -->
                        <div class="modal fade" id="followersModal" tabindex="-1" aria-labelledby="followersModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="followersModalLabel">{{ $user->username }}'s Followers
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <ul class="list-group">
                                            @foreach ($user->follower as $follower)
                                                <li class="list-group-item">
                                                    <a
                                                        href="{{ route('profile', ['username' => $follower->username]) }}">{{ $follower->name }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if (Auth::id() == $user->id)
                            <a href="{{ route('editProfileView', ['username' => $user->username]) }}"
                                class="btn btn-edit-profile mt-3">Edit Profile</a>
                        @endif
                    </div>
                </div>
            </div>

            <div class="col-md-8 scrollable-container">
                <div class="text-center mt-5" style="color:#840829">
                    <h3><strong>{{ $user->username }}'s uploads</strong></h3>
                </div>

                @include('show_memes')

                <div class="mt-5 text-center">
                    {{ $memes->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
