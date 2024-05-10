<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">{{ config('app.name') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText"
            aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarText">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ route('home') }}">Home</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('logout') }}">Log out</a>
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
            @auth
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item me-2">
                        <form class="d-flex align-items-center" action="/">
                            <div class="input-group">
                                <input class="form-control border-1 rounded-start me-2" type="search" placeholder="Search"
                                    aria-label="Search" name="search">
                                <button class="btn btn-outline-success rounded-end" type="submit">Search</button>
                            </div>
                        </form>
                    </li>

                    <li class="nav-item me-2">
                        <a href="" class="btn btn-outline-success">Notification</a>
                    </li>
                    <li class="nav-item">
                        <!-- User profile picture with link -->
                        <a href="{{ route('profile', ['username' => Auth::user()->username]) }}">
                            @if (Auth::user()->avatar)
                                <img src="{{ asset('storage/' . Auth::user()->avatar) }}" class="rounded-circle img-fluid"
                                    alt="User Profile Picture" style="width: 50px; height: 50px;">
                            @else
                                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=random" class="rounded-circle img-fluid"
                                    alt="User Profile Picture" style="width: 50px; height: 50px;">
                            @endif
                        </a>
                    </li>
                </ul>
            @endauth
        </div>
    </div>
</nav>
