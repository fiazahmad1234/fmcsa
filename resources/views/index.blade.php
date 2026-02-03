@extends('layout.dashboard1')

@section('dashboard-content')
<div class="row g-3">
    <div class="col-12">
        <h2 class="mb-4">Users List</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    </div>

    <div class="col-12">
        <div class="table-responsive">
            <table class="table table-bordered table-striped align-middle shadow-sm">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th>Assign Role</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td>
                            <form action="{{ route('admin.users.assignRole', $user->id) }}" method="POST" class="d-flex gap-2">
                                @csrf
                                <select name="role" class="form-select form-select-sm">
                                    <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                                    <option value="editor" @if($user->hasRole('editor')) selected @endif>Editor</option>
                                    <option value="user" @if($user->hasRole('user')) selected @endif>User</option>
                                </select>
                                <button type="submit" class="btn btn-sm btn-success">Assign</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
