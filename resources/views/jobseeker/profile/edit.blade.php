<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Job Seeker Profile</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white shadow-md rounded-lg w-full max-w-2xl p-8">
        <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Edit Profile</h2>

        @if ($errors->any())
            <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('success'))
    <div class="bg-green-100 text-green-800 p-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

        <form method="POST" action="{{ route('jobseeker.profile.update') }}" enctype="multipart/form-data" class="space-y-4">
            @method('PUT')
            @include('jobseeker.partials.form-fields')

            <div class="pt-4 text-center">
                <button type="submit" class="bg-green-600 text-white px-6 py-2 rounded hover:bg-green-700">
                    Update
                </button>
                <a href="{{ url('/jobseeker/dashboard') }}" class="inline-block mb-4 text-blue-600 hover:underline">
                    ← Back
                </a>
            </div>
        </form>
    </div>
</body>
</html>
