@extends('layout')
@section('title', 'Searched Users')
@section('content')

    {{-- searched users --}}
    <div class="container text-center">
        <h1 class="mt-5">Searched Users</h1>
    </div>

    <div class="container text-center">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3"> <!-- Adjust the number of columns based on your preference -->
            @foreach ($users as $user)
                <div class="col mb-4"> <!-- Add margin bottom for spacing between cards -->
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->username }}</p>
                            <p class="card-text">{{ $user->email }}</p>
                            <a href="{{ route('profile', ['username' => $user->username]) }}" class="btn btn-primary">Visit Profile</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>



@endsection
