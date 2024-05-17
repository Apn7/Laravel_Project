@extends('admin.alayout')
@section('title', 'Users')
@section('content')
    <div class="container">
        <h1>Manage Users</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @if ($user->is_admin==1)
                                <span class="badge bg-primary">Admin</span>
                            @else
                                <span class="badge bg-secondary">User</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-column flex-sm-row">
                                <div class="p-1">
                                    <a href="#" class="btn btn-warning btn-sm w-100">Edit</a>
                                </div>
                                <div class="p-1">
                                    <a href="#" class="btn btn-danger btn-sm w-100">Delete</a>
                                </div>
                                <div class="p-1">
                                    <a href="#" class="btn btn-primary btn-sm w-100 mt-2 mt-sm-0">Make Admin</a>
                                </div>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
