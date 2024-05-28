@extends('admin.alayout')
@section('title', 'Admin Dashboard')
@section('content')
<div class="container admin-dashboard">
    <div class="text-center mt-2">
        <h1>Admin Dashboard</h1>
        <p class="welcome-text mt-4"><b>Welcome to the admin panel!</b></p>
    </div>
    <div class="row">
        <!-- Total Memes Card -->
        <div class="col-md-4">
            <div class="card dashboard-card bg-gradient-primary">
                <div class="card-header">Total Memes</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $memes->count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Users Card -->
        <div class="col-md-4">
            <div class="card dashboard-card bg-gradient-success">
                <div class="card-header">Total Users</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $users->count() }}</h5>
                </div>
            </div>
        </div>

        <!-- Total Reports Card -->
        <div class="col-md-4">
            <div class="card dashboard-card bg-gradient-danger">
                <div class="card-header">Total Reports</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $reports->count() }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

