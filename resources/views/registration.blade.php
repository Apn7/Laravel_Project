@extends('layout')
@section('title','Register')

@section('content')
<div class="container login-container">
    <h2 class="text-center login-title mb-4">Register</h2>

    <div class="mt-5">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="login-form">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="login-label">Full Name</label>
                <input type="text" class="form-control login-input" id="name" name="name" placeholder="Enter your full name" value="{{ old('name') }}" required>
                @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="username" class="login-label">Username</label>
                <input type="text" class="form-control login-input" id="username" name="username" placeholder="Choose a username" value="{{ old('username') }}" required>
                @error('username') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email" class="login-label">Email address</label>
                <input type="email" class="form-control login-input" id="email" name="email" placeholder="Enter your email" value="{{ old('email') }}" required pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$" title="Email should follow the pattern: user@domain.com">
                @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password" class="login-label">Password</label>
                <input type="password" class="form-control login-input" id="password" name="password" placeholder="Create a password" required minlength="6">
                @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="login-label">Confirm Password</label>
                <input type="password" class="form-control login-input" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
                @error('password_confirmation') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn login-submit-btn">Register</button>
        </form>
    </div>
</div>

<!-- Bootstrap Modal for Validation Errors -->
<div class="modal fade" id="validationErrorModal" tabindex="-1" aria-labelledby="validationErrorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body" id="validationErrorMessage"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    function checkFormValidation() {
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;
        var email = document.getElementById('email').value;
        var errorMessage = '';

        if (!email.match(/[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$/)) {
            errorMessage = 'Please enter a valid email address.';
        }

        if (password.length < 6) {
            errorMessage += (errorMessage.length ? '<br>' : '') + 'Password must be at least 6 characters long.';
        }

        if (password !== confirmPassword) {
            errorMessage += (errorMessage.length ? '<br>' : '') + 'Passwords do not match!';
        }

        if (errorMessage.length) {
            var validationModal = new bootstrap.Modal(document.getElementById('validationErrorModal'));
            document.getElementById('validationErrorMessage').innerHTML = errorMessage;
            validationModal.show();
            return false;
        }

        return true;
    }
</script>
@endsection
