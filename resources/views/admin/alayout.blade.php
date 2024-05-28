<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Admin Dashboard')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet"/>
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
            background-color: #f4f4f9;
        }

        .navbar-custom {
            background-color: #343a40;
            border-bottom: 3px solid #6c757d;
        }

        .navbar-brand {
            margin-right: 2rem;
            transition: color 0.3s ease-in-out;
        }

        .navbar-brand:hover {
            color: #adb5bd;
        }

        .nav-link {
            margin-right: 1rem;
            position: relative;
            transition: color 0.3s ease-in-out;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            display: block;
            left: 0;
            bottom: -5px;
            background: #adb5bd;
            transition: width 0.3s;
        }

        .nav-link:hover {
            color: #adb5bd;
        }

        .nav-link:hover::after {
            width: 100%;
        }

        .main {
            padding: 2rem;
            min-height: 80vh;
        }

        footer {
            background-color: #343a40;
            color: #f8f9fa;
            text-align: center;
            padding: 1rem;
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .footer-text {
            margin-bottom: 0;
        }

        .admin-info {
            color: #f8f9fa;
            font-size: 0.9rem;
            margin-right: 1rem;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{ url('/admin') }}">Dashboard</a>
                <a class="nav-link" href="{{ url('/admin/users') }}">Manage Users</a>
                <a class="nav-link" href="{{ url('/admin/reports') }}">Reported Memes</a>
                <a class="nav-link" href="{{ url('/admin/context') }}">Upload Meme Context</a>
                <a class="nav-link" href="{{ url('/admin/manageContext')}}"> Meme Contexts Manage </a>
            </div>
            <div class="navbar-nav ms-auto d-flex align-items-center">
                <span class="admin-info">Logged in as: {{ Auth::user()->username }}</span>
                <a class="nav-link" href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="get" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</nav>
<main class="main">
    @yield('content')
</main>
<footer>
    <p class="footer-text">&copy; {{ date('Y') }} MemeGrove Admin Panel. All Rights Reserved.</p>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
