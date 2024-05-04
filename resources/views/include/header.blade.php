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
            <ul class="navbar-nav ml-auto"> <!-- Added ml-auto class for right alignment -->
                <li class="nav-item" style="margin-right: 10px">
                    <input type="text" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="button-addon2">
                </li>
                <li class="nav-item" style="margin-right: 10px">
                    <button class="btn btn-outline-success" type="button" id="button-addon2">Search</button>
                </li>
                <li class="nav-item" style="margin-right: 10px">
                    <a href="" class="btn btn-outline-success">Notification</a>
                </li>
                <li class="nav-item">
                    <!-- User profile picture with link -->
                    <a href="{{route('profile',['username' => Auth::user()->username])}}">
                        <img src="{{asset('storage/users_dp/user_dp.jpg')}}" class="rounded-circle img-fluid" alt="User Profile Picture" style="width: 50px; height: 50px;">
                    </a>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</nav>
