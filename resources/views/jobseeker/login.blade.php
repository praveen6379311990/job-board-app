
    {{-- <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #eef2f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
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
    </style> --}}
@extends('layouts.jobseeker_login_layout')
@section('content')
<div class="container-fluid login-wrapper">
    <div class="login-box">
        <h2>Job Seeker Login</h2>

        @if ($errors->any())
            <div class="error-msg">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ url('/login/jobseeker') }}">
            @csrf
            <div class="form-group">
                <label>Email:</label>
                <input type="email" name="email" value="{{ old('email') }}" required>
            </div>

            <div class="form-group">
                <label>Password:</label>
                <input type="password" name="password" required>
            </div>

            <button type="submit" class="btn">Login</button>
        </form>
    </div>
    </div>

@endsection
