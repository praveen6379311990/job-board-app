@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h2 class="mb-4">Job Seekers List</h2>

        <!-- Filter Form -->
        <form method="GET" action="{{ route('admin.dashboard') }}" class="row g-3 mb-4">
            <div class="col-md-2">
                <input type="text" name="name" class="form-control" placeholder="Name" value="{{ request('name') }}">
            </div>
            <div class="col-md-2">
                <input type="email" name="email" class="form-control" placeholder="Email"
                    value="{{ request('email') }}">
            </div>
            <div class="col-md-1">
                <input type="number" name="min_exp" class="form-control" placeholder="Min Exp"
                    value="{{ request('min_exp') }}">
            </div>
            <div class="col-md-1">
                <input type="number" name="max_exp" class="form-control" placeholder="Max Exp"
                    value="{{ request('max_exp') }}">
            </div>
            <div class="col-md-2">
                <input type="text" name="skills" class="form-control" placeholder="Skills"
                    value="{{ request('skills') }}">
            </div>
            <div class="col-md-2">
                <select name="location_id" class="form-control">
                    <option value="">Select Location</option>
                    @foreach ($locations as $location)
                        <option value="{{ $location->id }}"
                            {{ request('location_id') == $location->id ? 'selected' : '' }}>
                            {{ $location->city }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-2 text-start">
                <button type="submit" class="btn btn-primary">Filter</button>
                 <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ms-2">Clear</a>
            </div>
        </form>

        <!-- Job Seekers Table -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle">
                <thead class="table-dark">
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
                    @forelse ($jobSeekers as $jobSeeker)
                        <tr>
                            <td>{{ $jobSeeker->name }}</td>
                            <td>{{ $jobSeeker->email }}</td>
                            <td>{{ $jobSeeker->phone }}</td>
                            <td>{{ $jobSeeker->experience }} yrs</td>
                            <td>
                                @if ($jobSeeker->photo)
                                    <img src="{{ asset('storage/' . $jobSeeker->photo) }}" width="50"
                                        class="img-thumbnail" alt="Photo">
                                @else
                                    <span class="text-muted">No photo</span>
                                @endif
                            </td>
                            <td class=" cursor-pointer">
                                @if ($jobSeeker->resume)
                                    <a href="{{ route('admin.resume.download', basename($jobSeeker->resume)) }}"
                                        target="_blank" class="btn btn-sm btn-outline-success">Download</a>
                                @else
                                    <span class="text-muted">No resume</span>
                                @endif
                            </td>
                            <td class="d-flex gap-2">
                                <a href="{{ route('admin.jobseeker.view', $jobSeeker->id) }}"
                                    class="btn btn-sm btn-info">View</a>
                                <form action="{{ route('admin.jobseeker.delete', $jobSeeker->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?');">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted">No job seekers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
