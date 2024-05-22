<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container-fluid">

        <div class="navbar-search-logo-group">
            <!-- Logo -->
            <a class="navbar-brand" href="{{ route('home') }}">
                <img src="{{ asset('storage/memegrove_logo.jpg') }}" alt="Logo" style="height: 40px; width: 120px;">
            </a>

            <!-- Search bar -->
            <form class="d-flex align-items-center me-auto search-input-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search">
                <button class="btn btn-outline-primary" type="submit"><i class="ri-search-line"></i></button>
            </form>

            <!-- Toggler for mobile view -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
                aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>


        <!-- Right-aligned elements for user interaction -->
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item me-2 mt-4 list-group">
                    <a href="{{ route('trending') }}" class="list-group-item list-group-item-action">Trending Memes</a>
                    @auth
                        <a href="{{ route('my_feed') }}" class="list-group-item list-group-item-action">My Feed</a>
                    @endauth
                    <a href="{{ route('memeContext') }}" class="list-group-item list-group-item-action">Meme Context</a>
                </li>
                @auth
                    <li class="nav-item mt-2 me-5">
                        <a href="{{ route('notifications.index') }}" class="nav-link">Notifications
                            @if (Auth::user()->unreadNotifications() > 0)
                                <span class="badge bg-danger">{{ Auth::user()->unreadNotifications() }}</span>
                            @endif
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('profile', ['username' => Auth::user()->username]) }}">
                            <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) . '&background=random' }}"
                                class="rounded-circle" style="width: 40px; height: 40px;">
                        </a>
                    </li>
                    <li class="nav-item mt-2 ms-2">
                        <a class="nav-link" href="{{ route('logout') }}"><i class="ri-logout-circle-line"
                                style="width: 40px; height: 40px;"></i></a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
