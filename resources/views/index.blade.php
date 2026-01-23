<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
</head>
<body>

<h2>Users List</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<table border="1" cellpadding="10">
    <thead>
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
                    {{ $role->name }}
                @endforeach
            </td>
            <td>
                <form action="{{ route('admin.users.assignRole', $user->id) }}" method="POST">
                    @csrf
                    <select name="role">
                        <option value="admin" @if($user->hasRole('admin')) selected @endif>Admin</option>
                        <option value="editor" @if($user->hasRole('editor')) selected @endif>Editor</option>
                        <option value="user" @if($user->hasRole('user')) selected @endif>User</option>
                    </select>
                    <button type="submit">Assign</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

</body>
</html>
