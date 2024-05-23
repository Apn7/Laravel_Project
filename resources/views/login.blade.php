@extends('layout')
@section('title', 'Login')

@section('content')
<div class="container-fluid">
    <div class="row align-items-center login-page">
        <!-- Left column for title and intro -->
        <div class="col-md-6 login-intro">
            <h1 class="login-main-title">MemeGrove</h1>
            <p class="lead">
                MemeGrove helps you find and share the funniest memes with your friends.
                Enjoy and spread the laughter!
            </p>
        </div>

        <!-- Right column for login form -->
        <div class="col-md-6">
            <div class="container login-container">
                <h2 class="text-center login-title mb-4">Login</h2>

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

                    <form action="{{ route('login.post') }}" method="POST" class="login-form">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label login-label">Email address</label>
                            <input type="email" class="form-control login-input" name="email" placeholder="Enter your email">
                        </div>
                        <div class="mb-3">
                            <label class="form-label login-label">Password</label>
                            <input type="password" class="form-control login-input" name="password" placeholder="Enter your password">
                        </div>
                        <button type="submit" class="btn login-submit-btn">Login</button>
                    </form>

                    <!-- Registration Link -->
                    <div class="text-center mt-3">
                        New to MemeGrove? <a href="{{ route('register') }}" class="register-link">Register here</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
