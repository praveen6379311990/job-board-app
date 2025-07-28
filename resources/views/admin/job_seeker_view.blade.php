@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Job Seeker Details</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item"><strong>Name:</strong> {{ $jobSeeker->name }}</li>
                <li class="list-group-item"><strong>Email:</strong> {{ $jobSeeker->email }}</li>
                <li class="list-group-item"><strong>Phone:</strong> {{ $jobSeeker->phone }}</li>
                <li class="list-group-item"><strong>Experience:</strong> {{ $jobSeeker->experience }} years</li>
                <li class="list-group-item"><strong>Skills:</strong> {{ $jobSeeker->skills }}</li>
                <!-- <li class="list-group-item"><strong>Job Location:</strong> {{ $jobSeeker->location_id }}</li> -->
                <li class="list-group-item"><strong>Job Location:</strong> {{ $jobSeeker->location->city ?? 'Unknown' }}</li>
                <li class="list-group-item d-flex align-items-center">
                    <strong class="me-2">Photo:</strong>
                    @if ($jobSeeker->photo)
                        <img src="{{ asset('storage/' . $jobSeeker->photo) }}" width="100" class="img-thumbnail">
                    @else
                        <span>No photo</span>
                    @endif
                </li>
                <li class="list-group-item">
                    <strong>Resume:</strong>
                    @if ($jobSeeker->resume)
                        <a href="{{ route('admin.resume.download', basename($jobSeeker->resume)) }}" class="btn btn-sm btn-outline-primary ms-2" target="_blank">Download Resume</a>
                    @else
                        <span class="ms-2">No resume</span>
                    @endif
                </li>
                <li class="list-group-item">
                        <a href="{{ url()->previous() }}" class="inline-block mb-4 text-blue-600 hover:underline">
                    ← Back
                </a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
