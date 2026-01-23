<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

</head>
<body>

<h2>Login</h2>

@if ($errors->any())
    <p style="color:red">{{ $errors->first() }}</p>
@endif

<form method="POST" action="{{ route('login.submit') }}">
    @csrf

    <label>Email</label><br>
    <input type="email" name="email" value="{{ old('email') }}" required><br><br>

    <label>Password</label><br>
    <input type="password" name="password" required><br><br>

    <!-- Remember Me -->
    <label>
        <input type="checkbox" name="remember"> Remember Me
    </label>
    <br><br>

    <button type="submit">Login</button>
</form>

</body>
</html>
