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
        /* Registration Page Styles */

        body {
            background-color: #f8fafc;
            /* Tailwind's gray-100 */
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .registration-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #f8fafc;
        }

        .registration-card {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-radius: 12px;
            max-width: 640px;
            width: 100%;
            padding: 32px;
        }

        .registration-title {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 24px;
            text-align: center;
            color: #0d6efd;
        }

        .error-box {
            background-color: #f8d7da;
            color: #842029;
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .error-box ul {
            padding-left: 20px;
        }

        .register-btn {
            background-color: #0d6efd;
            color: white;
            padding: 10px 24px;
            border: none;
            border-radius: 6px;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .register-btn:hover {
            background-color: #0b5ed7;
        }

        .back-link {
            display: inline-block;
            margin-top: 12px;
            color: #0d6efd;
            text-decoration: none;
            font-size: 14px;
        }

        .back-link:hover {
            text-decoration: underline;
        }


        .navbar {
            background-color: #0d6efd;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .navbar-brand {
            color: white;
            text-decoration: none;
            font-weight: bold;
            font-size: 20px;
        }

        .navbar-links {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .navbar-links a,
        .navbar-links span {
            color: white;
            text-decoration: none;
        }

        .logout-btn {
            padding: 5px 10px;
            background-color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
        }

        .logout-btn:hover {
            background-color: #e2e6ea;
        }

        @media (max-width: 600px) {
            .navbar {
                flex-direction: column;
                align-items: flex-start;
            }

            .navbar-links {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
                margin-top: 10px;
            }
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">

    <nav class="navbar navbar-expand-lg navbar-custom">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">JobPortal</a>
            </button>

            @auth('jobseeker')
                <div class="navbar-links">
                    <span>Welcome, {{ auth('jobseeker')->user()->name }}</span>
                    <form method="POST" action="{{ route('jobseeker.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            @elseif(auth('admin')->check())
                <div class="navbar-links">
                    <span>Welcome, {{ auth('admin')->user()->name }}</span>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="logout-btn">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>
    {{-- Main Content --}}
    <div class="container mt-4">
        @yield('content')
    </div>
</body>

</html>
