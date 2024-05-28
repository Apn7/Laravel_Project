@extends('admin.alayout')
@section('title', 'Users')
@section('content')
<div class="container">
    <h1 class="mt-4 mb-4 text-center">Manage Users</h1>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        @if ($user->is_admin == 1)
                            <span class="badge bg-primary">Admin</span>
                        @else
                            <span class="badge bg-secondary">User</span>
                        @endif
                    </td>
                    <td>
                        <div class="d-flex flex-column flex-sm-row align-items-center">
                            @if ($user->is_admin == 0)
                                <!-- Delete User Form -->
                                <form action="{{ route('admin.deleteUser') }}" method="POST" class="d-inline-block me-2">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>

                                <!-- Make Admin Form -->
                                <form action="{{ route('admin.makeAdmin') }}" method="POST" class="d-inline-block">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                    <button type="submit" class="btn btn-primary btn-sm">Make Admin</button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
