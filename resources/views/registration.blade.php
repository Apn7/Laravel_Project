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

        @if (session()->has('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if (session()->has('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('register.post') }}" method="POST" class="login-form" onsubmit="return checkPasswordMatch()">
            @csrf
            <div class="form-group mb-3">
                <label for="name" class="login-label">Full Name</label>
                <input type="text" class="form-control login-input" id="name" name="name" placeholder="Enter your full name" required>
            </div>
            <div class="form-group mb-3">
                <label for="username" class="login-label">Username</label>
                <input type="text" class="form-control login-input" id="username" name="username" placeholder="Choose a username" required>
            </div>
            <div class="form-group mb-3">
                <label for="email" class="login-label">Email address</label>
                <input type="email" class="form-control login-input" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group mb-3">
                <label for="password" class="login-label">Password</label>
                <input type="password" class="form-control login-input" id="password" name="password" placeholder="Create a password" required>
            </div>
            <div class="form-group mb-3">
                <label for="password_confirmation" class="login-label">Confirm Password</label>
                <input type="password" class="form-control login-input" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
            </div>
            <button type="submit" class="btn login-submit-btn">Register</button>
        </form>
    </div>
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
        var password = document.getElementById('password').value;
        var confirmPassword = document.getElementById('password_confirmation').value;

        if (password != confirmPassword) {
            var passwordMismatchModal = new bootstrap.Modal(document.getElementById('passwordMismatchModal'));
            passwordMismatchModal.show();
            return false;
        }
        return true;
    }
</script>
@endsection
