@extends('layout')
@section('title', 'Searched Users')
@section('content')

<div class="container searched_user-container">
    <h1 class="text-center">Searched Users</h1>
    <div class="row">
        @foreach ($users as $user)
            <div class="col-md-4">
                <div class="card searched_user-card">
                    <div class="card-body searched_user-body">
                        <h5 class="searched_user-title">{{ $user->name }}</h5>
                        <p class="searched_user-text">{{ $user->username }}</p>
                        <p class="searched_user-text">{{ $user->email }}</p>
                        <a href="{{ route('profile', ['username' => $user->username]) }}" class="btn custom-button">Visit Profile</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
