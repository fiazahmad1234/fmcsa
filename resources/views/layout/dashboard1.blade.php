@extends('layout.app')

@section('content')
<div class="container-fluid mt-5">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-dark sidebar vh-100 text-white mt-5">
            <div class="sidebar-sticky pt-3">
  <div class="section-heading">
            <h2> <span class="text-white">Track</span> <span>&Go</span></h2></div>
             <style>
    /* Custom Sidebar Styling */
    .sidebar-nav {
        background-color: #1a222b; /* Match the dark navy from image */
        padding: 20px 0;
    }

    .nav-header {
        font-size: 0.75rem;
        font-weight: 700;
        color: #ff4d4d; /* Red label color */
        padding: 1rem 1.5rem;
        letter-spacing: 1px;
    }

    .sidebar-nav .nav-link {
        color: #adb5bd !important;
        padding: 0.8rem 1.5rem;
        border-bottom: 1px solid #252e38; /* Thin divider */
        font-size: 0.9rem;
        text-transform: uppercase;
        font-weight: 500;
        transition: all 0.3s;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .sidebar-nav .nav-link:hover {
        background-color: #252e38;
        color: #ffffff !important;
    }

    .sidebar-nav .nav-link.active {
        color: #ffffff !important;
        border-left: 4px solid #ff4d4d; /* Red active indicator */
    }

    /* Style for the 'NEW' badge */
    .badge-new {
        background-color: #ff4d4d;
        font-size: 0.65rem;
        padding: 3px 8px;
        border-radius: 50px;
        color: white;
    }
</style>

<div class="sidebar-nav h-100" style="width: 260px;">
    <ul class="nav flex-column">
        <li class="nav-item">
              <a class="nav-link" href="{{route('dashboard')}}">
           Dashboard
            </a></li>

        <li class="nav-item">
            <a class="nav-link" href="#">
                PROFILE <span class="badge-new">NEW</span>
            </a>
        </li>
        
        <li class="nav-item">
            <a class="nav-link" href="#">SETTINGS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link active" href="#">
                PROJECTS <span class="badge-new">NEW</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">TASKS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="#">FORMS</a>
        </li>

        <li class="nav-item">
            <a class="nav-link text-info" href="{{url('users')}}">
                <span><i class="bi bi-house-door me-2"></i>users</span>
            </a>
        </li>
    </ul>
</div>
            </div>
        </nav>

        <!-- Main content -->
        <main class="col-md-10 ms-sm-auto px-4 mt-5">
            <!-- Top bar -->
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-4 border-bottom">
                <h2>Dashboard</h2>
                <div class="position-relative">
                    <i class="bi bi-chat-left-text fs-4"></i>
                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                        5
                    </span>
                </div>
            </div>

            @yield('dashboard-content')
        </main>
    </div>
</div>
@endsection
