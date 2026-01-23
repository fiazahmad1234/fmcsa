<!DOCTYPE html>
<html>
<head>
    <title>Create Subject</title>
</head>
<body>

<h2>Create Subject</h2>

@if(session('success'))
    <p style="color:green">{{ session('success') }}</p>
@endif

<form method="POST" action="{{ route('subject.store') }}">
    @csrf

    <label>Name</label><br>
    <input type="text" name="name" required><br><br>

    <label>Description</label><br>
    <textarea name="description"></textarea><br><br>

    <button type="submit">Save</button>
</form>

</body>
</html>
