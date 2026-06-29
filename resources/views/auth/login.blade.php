<!DOCTYPE html>
<html>
<head>
    <title>Login Bioskop</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            background: url('https://images.unsplash.com/photo-1489599849927-2ee91cede3ba') no-repeat center center/cover;
            font-family: Arial, sans-serif;
        }

        /* overlay gelap */
        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.75);
            top: 0;
            left: 0;
        }

        /* login card */
        .login-box {
            position: relative;
            z-index: 2;
            width: 380px;
            margin: auto;
            top: 50%;
            transform: translateY(-50%);
            padding: 30px;
            background: rgba(255,255,255,0.08);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            box-shadow: 0 0 20px rgba(255,255,255,0.1);
            color: white;
        }

        .login-title {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            letter-spacing: 2px;
        }

        .form-control {
            background: rgba(255,255,255,0.1);
            border: none;
            color: white;
        }

        .form-control::placeholder {
            color: #ddd;
        }

        .btn-cinema {
            background: #e50914;
            border: none;
            width: 100%;
            padding: 10px;
            font-weight: bold;
            transition: 0.3s;
        }

        .btn-cinema:hover {
            background: #ff1f2d;
            transform: scale(1.03);
        }

        .small-text {
            text-align: center;
            margin-top: 10px;
            font-size: 13px;
        }
    </style>
</head>

<body>

<div class="overlay"></div>

<div class="login-box">

    <h3 class="login-title">🎬 BIOSKOP LOGIN</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf

        <input type="email" name="email" class="form-control mb-3" placeholder="Email">

        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

        <button class="btn btn-cinema">LOGIN</button>
    </form>

    <p class="text-center mt-3">
    Belum punya akun?
    <a href="/register">Register</a>
</p>

</div>

</body>
</html>