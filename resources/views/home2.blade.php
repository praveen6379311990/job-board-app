<!DOCTYPE html>
<html>
<head>
    <title>Job Portal</title>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            height: 100vh;
            align-items: center;
            justify-content: center;
        }
        .container {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.1);
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        .btn {
            display: inline-block;
            text-decoration: none;
            background-color: #3490dc;
            color: white;
            padding: 12px 25px;
            border-radius: 6px;
            margin: 10px;
            transition: background 0.3s;
        }
        .btn:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Welcome to the Job Portal</h2>
        <a href="{{ url('/register/jobseeker') }}" class="btn">Register as Job Seeker</a>
        <a href="{{ url('/login/jobseeker') }}" class="btn">Login as Job Seeker</a>
        <br>
        <a href="{{ url('/login/admin') }}" class="btn" style="background-color:#6c757d;">Admin Login</a>
    </div>
</body>
</html>
