<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

</head>

<body class="container mt-5">

<h3>Register Akun</h3>

@if($errors->any())
<div class="alert alert-danger">

    @foreach($errors->all() as $error)

        <div>{{ $error }}</div>

    @endforeach

</div>
@endif

<form method="POST" action="/register">

    @csrf

    <input
        type="text"
        name="name"
        class="form-control mb-3"
        placeholder="Nama"
        required>

    <input
        type="email"
        name="email"
        class="form-control mb-3"
        placeholder="Email"
        required>

    <input
        type="password"
        name="password"
        class="form-control mb-3"
        placeholder="Password"
        required>

    <!-- TAMBAHAN -->
    <input
        type="password"
        name="password_confirmation"
        class="form-control mb-3"
        placeholder="Konfirmasi Password"
        required>

    <button class="btn btn-success">
        Register
    </button>

</form>

<p class="mt-3">
    Sudah punya akun?
    <a href="/login">Login</a>
</p>

</body>
</html>