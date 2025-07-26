@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Job Seekers List</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.dashboard') }}">
            <input type="text" name="name" placeholder="Name" value="{{ request('name') }}">
            <input type="email" name="email" placeholder="Email" value="{{ request('email') }}">
            <input type="number" name="min_exp" placeholder="Min Experience" value="{{ request('min_exp') }}">
            <input type="number" name="max_exp" placeholder="Max Experience" value="{{ request('max_exp') }}">
            <input type="text" name="skills" placeholder="Skills" value="{{ request('skills') }}">
            <input type="text" name="job_location" placeholder="Job Location" value="{{ request('job_location') }}">
            <button type="submit">Filter</button>
        </form>

        <!-- Job Seekers Table -->
        <table>
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Experience</th>
                    <th>Photo</th>
                    <th>Resume</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($jobSeekers as $jobSeeker)
                    <tr>
                        <td>{{ $jobSeeker->name }}</td>
                        <td>{{ $jobSeeker->email }}</td>
                        <td>{{ $jobSeeker->phone }}</td>
                        <td>{{ $jobSeeker->experience }}</td>
                        <td>
                            @if ($jobSeeker->photo)
                                <img src="{{ route('admin.photo', $jobSeeker->photo) }}" width="50">
                            @endif
                        </td>
                        <td>
                            @if ($jobSeeker->resume)
                                <a href="{{ route('admin.resume.download', $jobSeeker->resume) }}">Download</a>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.jobseeker.view', $jobSeeker->id) }}">View</a>
                            <form action="{{ route('admin.jobseeker.delete', $jobSeeker->id) }}" method="POST"
                                onsubmit="return confirm('Are you sure?');">
                                @csrf @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
