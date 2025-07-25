@extends('layouts.app')
@section('content')
    <div class="bg-gray-100 flex items-center justify-center min-h-screen">
        <div class="bg-white shadow-md rounded-lg w-full max-w-2xl p-8">
            <h2 class="text-2xl font-bold mb-6 text-center text-blue-600">Register as Job Seeker</h2>

            @if ($errors->any())
                <div class="bg-red-100 text-red-800 p-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ url('/register/jobseeker') }}" enctype="multipart/form-data" class="space-y-4">
                @include('jobseeker.partials.form-fields')
                <div class="pt-4 text-center">
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                        Register
                    </button>
                    <a href="{{ url()->previous() }}" class="inline-block mb-4 text-blue-600 hover:underline">
                        ← Back
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection
