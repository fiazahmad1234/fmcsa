@extends('layout.app') {{-- use your main layout --}}
@section('content')

<div class="container d-flex justify-content-center align-items-center main-banner" style="min-height: 80vh ;">
    <div class="login-card main-banner">
        <h2>Login</h2>

        @if ($errors->any())
            <p class="error-message">{{ $errors->first() }}</p>
        @endif

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ old('email') }}" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3 remember-me">
                <input type="checkbox" name="remember" id="remember">
                <label for="remember" class="mb-0">Remember Me</label>
            </div>

            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</div>

<style>
    /* Keep your design exactly the same as your standalone HTML */
    body {
        background: linear-gradient(135deg, #f5f7fa, #c3cfe2);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    .login-card {
        background: #fff;
        padding: 2rem;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        width: 100%;
        max-width: 400px;
    }

    .login-card h2 {
        margin-bottom: 1.5rem;
        font-weight: 700;
        color: #333;
        text-align: center;
    }

    .form-control:focus {
        box-shadow: none;
        border-color: #6c63ff;
    }

    .btn-primary {
        width: 100%;
        background-color: #6c63ff;
        border: none;
    }

    .btn-primary:hover {
        background-color: #574fd1;
    }

    .remember-me {
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .error-message {
        color: red;
        margin-bottom: 1rem;
        text-align: center;
    }
</style>

@endsection
