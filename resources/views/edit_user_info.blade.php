@extends('layout')
@section('title', 'Edit Profile')
@section('content')

<div class="container text-center">
    <h1 class="mt-5 edit-profile-title">Edit User Details</h1>
</div>

<div class="container edit-profile-container">
    <form action="{{ route('editProfile') }}" method="post" class="ms-auto me-auto mt-3 edit-profile-form">
        @csrf
        <div class="form-group mb-3">
            <label for="name" class="edit-profile-label">Name</label>
            <input type="text" class="form-control edit-profile-input" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div class="form-group mb-3">
            <label for="username" class="edit-profile-label">Username</label>
            <input type="text" class="form-control edit-profile-input" id="username" name="username" value="{{ old('username', $user->username) }}" required>
            @error('username')
                <span class="text-danger edit-profile-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="email" class="edit-profile-label">Email</label>
            <input type="email" class="form-control edit-profile-input" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            @error('email')
                <span class="text-danger edit-profile-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="bio" class="edit-profile-label">Bio</label>
            <input type="text" class="form-control edit-profile-input" id="bio" name="bio" value="{{ $user->bio }}">
        </div>
        <button type="submit" class="btn btn-primary edit-profile-button">Update</button>
    </form>
</div>

<div class="container text-center">
    <h1 class="mt-5 edit-profile-title">Change Password</h1>
</div>

<div class="container edit-profile-container mt-3">
    <form action="{{ route('editPass') }}" method="post" class="ms-auto me-auto mt-3 edit-profile-form" onsubmit="return checkPasswordMatch()">
        @csrf
        <div class="form-group mb-3">
            <label for="current" class="edit-profile-label">Current Password</label>
            <input type="password" class="form-control edit-profile-input" id="current" name="current" required>
            @error('current')
                <span class="text-danger edit-profile-error">{{ $message }}</span>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="new" class="edit-profile-label">New Password</label>
            <input type="password" class="form-control edit-profile-input" id="new" name="new" required>
        </div>
        <div class="form-group mb-3">
            <label for="new_confirmation" class="edit-profile-label">Confirm New Password</label>
            <input type="password" class="form-control edit-profile-input" id="new_confirmation" name="new_confirmation" required>
        </div>
        <button type="submit" class="btn btn-primary edit-profile-button">Update</button>
        <div class="mt-3">
            @if (session()->has('success'))
                <div class="alert alert-success edit-profile-alert">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </form>
</div>

<!-- Bootstrap Modal for Password Mismatch Alert -->
<div class="modal fade" id="passwordMismatchModal" tabindex="-1" aria-labelledby="passwordMismatchModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body">
                Passwords do not match! Please try again.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function checkPasswordMatch() {
        var password = document.getElementById('new').value;
        var confirmPassword = document.getElementById('new_confirmation').value;

        if (password != confirmPassword) {
            var passwordMismatchModal = new bootstrap.Modal(document.getElementById('passwordMismatchModal'));
            passwordMismatchModal.show();
            return false;
        }
        return true;
    }
</script>
@endsection
