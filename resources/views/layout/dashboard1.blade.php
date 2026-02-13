<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'FMCSA App')</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/tailwindcss@3.3.2/dist/tailwind.min.css" rel="stylesheet">
            <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
 <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Custom CSS -->
         <link rel="stylesheet" href="{{ asset('assets/css/animated.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/owl.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/templatemo-space-dynamic.css') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<style>
    body{
        margin:2px;
    }
    </style>
<body>
<div class="container-fluid">
    <div class="row">
       
<style>
    :root {
        --sidebar-bg: #1e293b;         /* Slate-900: Professional & easy on the eyes */
        --sidebar-hover: #334155;      /* Slate-700 */
        --accent-color: #38bdf8;       /* Light Blue accent */
        --nav-text: #94a3b8;           /* Muted text */
    }

    .sidebar {
        background-color: var(--sidebar-bg);
        min-height: 100vh;
        padding: 1.5rem 0;
        transition: all 0.3s ease;
    }

    /* Logo Styling */
    .section-heading h2 {
        font-size: 1.2rem;
        font-weight: 800;
        letter-spacing: 0.5px;
        padding: 0 1.5rem 2rem;
        margin-bottom: 0;
        display:flex;
        justify-content:center;
    }
    .logo-accent { color: var(--accent-color); }

    /* Nav Links */
    .nav-link {
        color: var(--nav-text) !important;
        padding: 0.8rem 1.5rem !important;
        font-size: 0.875rem;
        font-weight: 500;
        display: flex;
        align-items: center;
        border-left: 3px solid transparent;
        transition: 0.2s;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .nav-link i {
        font-size: 1.1rem;
        margin-right: 12px;
    }

    .nav-link:hover {
        background-color: var(--sidebar-hover);
        color: #ffffff !important;
        border-left: 3px solid var(--accent-color);
    }

    /* Active State */
    .nav-link.active {
        background-color: rgba(56, 189, 248, 0.1);
        color: #ffffff !important;
        border-left: 3px solid var(--accent-color);
    }

    /* Badge Styling */
    .badge-new {
        background: var(--accent-color);
        color: #000;
        font-size: 0.65rem;
        padding: 2px 6px;
        border-radius: 4px;
        margin-left: auto;
        font-weight: 700;
    }
</style>

<nav class="col-md-2  d-none d-md-block sidebar shadow-lg position-relative">
    <div class="sidebar-sticky">
        <div class="section-heading">
            <h2 class="text-white">
           <a href="{{url('home')}}">    TRACK<span class="logo-accent">&GO</span></a>
            </h2>
        </div>

        <ul class="nav flex-column mt-2">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('dashboard')}}">
                    <i class="bi bi-grid-1x2-fill"></i> DASHBOARD
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="{{ route('profile')}}">
                    <i class="bi bi-person-circle"></i>PROFILE 
                </a>
            </li>


            <li class="nav-item">
                <a class="nav-link" href="{{route('user-plan')}}">
                    <i class="bi bi-check2-square"></i> Plans
                </a>
                
            <li class="nav-item">
                <a class="nav-link" href="{{route('email-users')}}">
                    <i class="bi bi-check2-square"></i>Email set
                </a>
            </li>
             <li class="nav-item">
                <a class="nav-link" href="{{url('home')}}">
                    <i class="bi bi-briefcase"></i>HOME
                   
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link text-danger p-0">
                        <i class="bi bi-box-arrow-right"></i> Sign Out
                    </button>
                </form>
            </li>
            <hr class="mx-3 my-4 border-secondary opacity-25">
    <li class="nav-item">
        <a class="nav-link" href="{{ url('users') }}">
            <i class="bi bi-people"></i> USERS
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="{{ url('paid-users') }}">
            <i class="bi bi-people"></i> Premium User
        </a>
    </li>
    <li class="nav-item">
    <a class="nav-link" href="{{ url('all-configuration') }}">
        <i class="bi bi-envelope-fill"></i> All Mails
    </a>
</li>
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard-contacts') }}">
        <i class="bi bi-envelope-fill"></i> Message
    </a>
</li>
 <li class="nav-item">
    <a class="nav-link" href="{{ route('subscriber-all') }}">
         <i class="bi bi-people"></i> Subscriber
         <!-- <span class="badge bg-danger ms-2"> new<span> -->
    </a>
</li>


        </ul>
         <div class="settings-link position-absolute text-start" 
             style="bottom:2px; width:100%;">
            <a href="" class="nav-link d-inline-flex flex-column align-items-center justify-content-center"
               style="padding:0.5rem; border-radius:0.5rem; color:#38bdf8;">
                <i class="bi bi-gear-fill"><small>Settings</small></i>
            </a>
        </div>
    </div>
</nav>
<style>
    </style>
        <!-- Main content -->
<main class="col-md-10 ms-sm-auto px-4">
            <!-- Top bar -->
           <div class="d-flex justify-content-center justify-content-md-between align-items-center gap-2 gap-md-3 flex-wrap flex-md-nowrap p-md-3 p-0 mb-2 mb-md-0">

            <div class="section-heading" >
            <h2 class=""style="padding:1px;">Track<em>&Go</em><span>-Welcome,</span> {{ auth()->user()->name ?? 'Guest' }}</h2>
            </div>
            <div class="d-flex align-items-center position-relative gap-3">
            <div>
            <!-- Fullscreen Icon Button -->
            <i id="fullscreenBtn" class="fa-solid fa-expand" style="font-size:25px; cursor:pointer;"></i>
            </div>
        
           <a href="{{route('checkout')}}"><button id="zoomBtn" class="zoom-btn">
                <i class="fa-solid fa-credit-card me-2"></i> Payment
            </button>

</a>

            <div class="fb-avatar" data-bs-toggle="modal" data-bs-target="#avatarModal">
                <img id="profileAvatar"
                    src="{{ auth()->user()->profile_image ? asset('storage/profile_images/' . auth()->user()->profile_image) : asset('assets/images/user-placholder.jpg') }}">
            </div>

</div>
<!-- Modal -->
<div class="modal fade" id="avatarModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h6 class="modal-title">Update profile picture</h6>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body text-center">
                <div class="fb-crop-area" id="cropArea">
                    <img id="avatarPreview"
                         src="{{ auth()->user()->profile_image ? asset('storage/profile_images/' . auth()->user()->profile_image) : asset('images/default-user.png') }}">
                </div>

                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="mt-3">
                    @csrf
                    <label class="btn btn-light border">
                        <i class="bi bi-camera me-2"></i>
                        Upload photo
                        <input type="file" name="profile_image" hidden onchange="previewAvatar(event)">
                    </label>
                    <button type="submit" class="btn btn-primary mt-3">Save</button>
                </form>
            </div>

        </div>
    </div>
</div><script>
const cropArea = document.getElementById('cropArea');
const img = document.getElementById('avatarPreview');
const mainAvatar = document.getElementById('profileAvatar');

let dragging = false;
let startX = 0, startY = 0;
let imgX = 0, imgY = 0;

/* Preview selected image before saving */
function previewAvatar(e) {
    const file = e.target.files[0];
    if (!file) return;

    const objectURL = URL.createObjectURL(file);
    img.src = objectURL;
    mainAvatar.src = objectURL;

    imgX = imgY = 0;
    img.style.left = '0px';
    img.style.top  = '0px';
}

/* Drag logic */
cropArea.addEventListener('mousedown', e => {
    dragging = true;
    cropArea.style.cursor = 'grabbing';
    startX = e.clientX - imgX;
    startY = e.clientY - imgY;
});

document.addEventListener('mouseup', () => {
    dragging = false;
    cropArea.style.cursor = 'grab';
});

document.addEventListener('mousemove', e => {
    if (!dragging) return;

    imgX = e.clientX - startX;
    imgY = e.clientY - startY;

    img.style.left = imgX + 'px';
    img.style.top = imgY + 'px';
});
</script>
<style>
.fb-avatar {
    position: relative;
    width: 44px;
    height: 44px;
    border-radius: 50%;
    overflow: hidden;
    cursor: pointer;
}
.fb-avatar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}
.fb-avatar::after {
    content: "\f030";
    font-family: "Bootstrap-icons";
    position: absolute;
    inset: 0;
    background: rgba(0,0,0,.45);
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: .2s;
}
.fb-avatar:hover::after { opacity: 1; }

.fb-crop-area {
    width: 180px;
    height: 180px;
    border-radius: 50%;
    overflow: hidden;
    margin: auto;
    background: #f0f2f5;
    position: relative;
    cursor: grab;
}
.fb-crop-area img {
    position: absolute;
    top: 0;
    left: 0;
    width: 240px;
    user-select: none;
    pointer-events: none;
}
</style>
            </div>

            @yield('dashboard-content')
        </main>
    </div>
</div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('assets/js/script.js') }}"></script>

</body>
</html>
