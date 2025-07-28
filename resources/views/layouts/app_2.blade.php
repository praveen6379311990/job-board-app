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

        /* body {
            background-color: #f8fafc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        } */
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;

            align-items: center;
            justify-content: center;
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
        @yield('content')
</body>

</html>
