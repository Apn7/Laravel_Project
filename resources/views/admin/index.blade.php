@extends('admin.alayout')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container">
    <div class="text-center mb-5">
        <h1>Admin Dashboard</h1>
        <p> <b>Welcome to the admin panel! </b> </p>
    </div>
    <div class="row">
        <!-- Total Memes Card -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3">
                <div class="card-header">Total Memes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $memes->count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $users->count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Reports Card -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-header">Total Reports</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $reports->count() }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
