@extends('layout')
@section('title', 'edit meme description')
@section('content')

    {{-- meme description edit form --}}
    <div class="container text-center">
        <h1 class="mt-5">Edit User Details</h1>
    </div>
    <div class="container">
        <form action="{{ route('editProfile') }}" method="post" class="ms-auto me-auto mt-3" style="width: 500px">
            @csrf
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}"
                    required>
            </div>
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="{{ old('email', $user->email) }}" required>
                @error('email')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <label for="bio">Bio</label>
                <input type="text" class="form-control" id="bio" name="bio" value="{{ $user->bio }}">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>

    <div class="container text-center">
        <h1 class="mt-5">Change Password</h1>
    </div>

    <div class="container mt-3">
        <form action="{{ route('editPass') }}" method="post" enctype="multipart/form-data" class="ms-auto me-auto mt-3"
            style="width: 500px">
            @csrf
            <div class="form-group">
                <label for="current">Current Password</label>
                <input type="password" class="form-control" id="current" name="current" required>
                @error('current')
                    <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <label for="new">New Password</label>
                <input type="password" class="form-control" id="new" name="new" required>
            </div>
            <div class="form-group">
                <label for="new_confirmation">Confirm New Password</label>
                <input type="password" class="form-control" id="new_confirmation" name="new_confirmation" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <div class="mt-3">
                @if (session()->has('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
        </form>
    </div>


@endsection
