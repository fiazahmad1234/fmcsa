@extends('layout.app')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

<div class="main-wrapper">
    <div class="glass-container mt-5">
        <!-- Header -->
        <div class="header-section">
            <h1 class="main-title" id="form-title">Reset your password</h1>
             <p class="text-light">Provide your email, and we'll send a reset link.</p>
        </div>

        <!-- Error messages -->
  @if(session('status')) <p style="color:green;">{{ session('status') }}</p> @endif
@if($errors->any()) <p style="color:red;">{{ $errors->first() }}</p> @endif


        <!-- Login Form -->
<form method="POST" action="{{ route('password.email') }}">
            @csrf
            <div class="custom-input-group">
                <label>Email</label>
                <input type="email" name="email" placeholder="username@gmail.com" required>
            </div>
            <button type="submit" class="btn-signin">continue</button>
<div style="text-align: center; margin-top: 10px;">
    <a  href="{{ route('login') }}" class="text-light" style="text-decoration: none; color: #1D4ED8; font-weight: bold;">
        Sign in
    </a>
</div>
            </div>
        </form>
           
    </div>
</div>
<style>
/* Glassy background & styling */
.main-wrapper { min-height: 100vh; display:flex; justify-content:center; align-items:center; background-image:url('assets/images/login-background.jpg'); background-size:cover; background-position:center; padding:20px; font-family:'Inter',sans-serif; }
.glass-container { background: rgba(0,52,102,0.4); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-left:1px solid red; border-top:1px solid #03a4ed; border-bottom:1px solid red; border-right:1px solid #03a4ed; border-radius:24px; width:100%; max-width:460px; padding:40px; box-shadow:0 20px 40px rgba(0,0,0,0.3); color:white; }
.main-title { font-weight:700; font-size:2.2rem; margin-bottom:25px; }
.custom-input-group { margin-bottom:18px; text-align:left; }
.custom-input-group label { display:block; font-size:0.8rem; margin-bottom:6px; opacity:0.9; }
.custom-input-group input { width:100%; padding:12px 16px; border-radius:10px; border:none; outline:none; background:#ffffff; color:#333; font-size:0.9rem; }
.password-field { position:relative; }
.password-field i { position:absolute; right:15px; top:50%; transform:translateY(-50%); color:#999; cursor:pointer; }
.btn-signin { width:100%; background:#001f3f; color:white; border:none; padding:14px; border-radius:10px; font-weight:600; margin-bottom:20px; transition:0.3s ease; }
.btn-signin:hover { background:#00152b; transform:translateY(-1px); }
.or-divider { text-align:center; border-bottom:1px solid rgba(255,255,255,0.2); line-height:0.1em; margin:25px 0; font-size:0.75rem; opacity:0.6; }
.or-divider span { background: rgba(0,52,102,0.1); padding:0 10px; }
.social-row { display:flex; justify-content:space-between; gap:12px; margin-bottom:25px; }
.social-box { flex:1; background:#ffffff; height:45px; border-radius:10px; display:flex; justify-content:center; align-items:center; text-decoration:none; transition:0.2s; }
.social-box:hover { background:#f8f9fa; }
.social-box img { width:20px; }
.register-text { text-align:center; font-size:0.8rem; opacity:0.9; }
.register-text a { color:white; font-weight:bold; text-decoration:none; cursor:pointer; }
/* checkbox css */
.custom-input-group label {
    display: flex;
    align-items: center;
    gap: 5px; /* space between checkbox and text */
    cursor: pointer;
}

.custom-input-group input[type="checkbox"] {
    width: 16px;
    height: 16px;
}

</style>

@endsection
