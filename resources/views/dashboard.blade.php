<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Dashboard one</a>
        <div class="d-flex">
            <span class="navbar-text text-white">
            </span>
        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-white sidebar collapse border-end">
            <div class="position-sticky pt-3">
                <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-3 text-muted">
                    <form method="POST" action="{{ route('logout') }}">
    @csrf
                    <button
                        type="submit"
                        class="bg-red-500 bg-danger border px-4 py-2 ronded text-white text-sm">
                        Logout
                    </button>
           </form>
                </h6>
                <ul class="nav flex-column">
                    @role('admin')
                    <button type="button" class="btn btn-primary">
  Notifications <span class="badge badge-light">{{$tottalproject}}</span>
</button>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><div class="bg-white p-4 rounded shadow mb-4">
                        <p class="text-gray-700">
                        <strong>Login Time:</strong>
 @foreach($data as $attendance)
                <tr>
                    <td>{{ $attendance->id }}</td>
                    <td>{{ $attendance->user_id }}</td>
                    <td>{{ $attendance->status }}</td>
                    <td>{{ $attendance->created_at->format('Y-m-d H:i') }}</td>
                </tr>
            @endforeach                        </p>
                        </div></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Assign Roles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Reports</a>
                    </li>
                    @endrole

                    @role('editor')
                    <li class="nav-item">
                        <a class="nav-link" href="#">Edit Articles</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Submissions</a>
                    </li>
                    @endrole

                    <!-- Common for all users -->
                    <li class="nav-item">
                        <a class="nav-link" href="#">View Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Change Password</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">

            <!-- Admin Section -->
            @role('admin')
            <div class="card mb-4">
                <div class="card-header">
                    Admin Panel
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card text-center bg-primary text-white">
                                <div class="card-body">Manage Users</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-primary text-white">
                                <div class="card-body">Assign Roles</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card text-center bg-primary text-white">
                                <div class="card-body">View Reports</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endrole
            <!-- Editor Section -->
            @role('editor')
            <div class="card mb-4">
                <div class="card-header">
                    Editor Panel
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card text-center bg-success text-white">
                                <div class="card-body">Edit Articles</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center bg-success text-white">
                                <div class="card-body">View Submissions</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endrole
            <ul class="nav flex-column">
    @can('view users')
    <li class="nav-item"><a class="nav-link" href="#">View Users</a></li>
    @endcan

    @can('create users')
    <li class="nav-item"><a class="nav-link" href="#">Create Users</a></li>
    @endcan

    @can('edit users')
    <li class="nav-item"><a class="nav-link" href="#">Edit Users</a></li>
    @endcan

    @can('delete users')
    <li class="nav-item"><a class="nav-link" href="#">Delete Users</a></li>
    @endcan
</ul>
            <div class="card mb-4">
                <div class="card-header">
                    User Functions
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="card text-center bg-warning">
                                <div class="card-body">View Profile</div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card text-center bg-warning">
                                <div class="card-body">Change Password</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</div>
<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
