<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
    .navbar-custom {
        background-color: #0d6efd;
    }

    .navbar-custom .nav-link,
    .navbar-custom .navbar-brand {
        color: #fff;
    }

    .navbar-custom .nav-link:hover {
        color: #e2e6ea;
    }

    body {
        font-family: 'Segoe UI', sans-serif;
        background-color: #eef2f7;
        margin: 0;
        padding: 0;
    }

    /* NEW: Wrap login in its own flex container */
.login-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: calc(90vh - 150px); /* Subtract navbar height */
    margin-top: 56px; /* Push down so it doesn't hide behind navbar */
}

    .login-box {
        background-color: #fff;
        padding: 40px;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        width: 350px;
    }

    .login-box h2 {
        text-align: center;
        margin-bottom: 25px;
    }

    .form-group {
        margin-bottom: 15px;
    }

    label {
        display: block;
        font-weight: 600;
    }

    input[type="email"], input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-top: 5px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .btn {
        width: 100%;
        background-color: #3490dc;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 6px;
        font-size: 16px;
        cursor: pointer;
    }

    .btn:hover {
        background-color: #2779bd;
    }

    .error-msg {
        color: red;
        font-size: 14px;
    }
</style>


    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    {{-- Header --}}
    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">JobPortal</a>

            <div class="collapse navbar-collapse justify-content-between">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">Home</a>
                    </li>
                </ul>

                <ul class="navbar-nav">
                    <li class="nav-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="btn btn-sm btn-outline-light">Logout</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    {{-- Main Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>
