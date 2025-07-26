@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Job Seeker Detail</h2>
    <ul>
        <li><strong>Name:</strong> {{ $jobSeeker->name }}</li>
        <li><strong>Email:</strong> {{ $jobSeeker->email }}</li>
        <li><strong>Phone:</strong> {{ $jobSeeker->phone }}</li>
        <li><strong>Experience:</strong> {{ $jobSeeker->experience }}</li>
        <li><strong>Skills:</strong> {{ $jobSeeker->skills }}</li>
        <li><strong>Job Location:</strong> {{ $jobSeeker->job_location }}</li>
        <li><strong>Photo:</strong>
            @if($jobSeeker->photo)
                <img src="{{ asset('uploads/photos/'.$jobSeeker->photo) }}" width="100">
            @endif
        </li>
        <li><strong>Resume:</strong>
            @if($jobSeeker->resume)
                <a href="{{ asset('uploads/resumes/'.$jobSeeker->resume) }}" download>Download Resume</a>
            @endif
        </li>
    </ul>
</div>
@endsection
