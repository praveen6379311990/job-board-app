@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Job Seeker Dashboard</h4>
        </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Edit Profile</span>
                    <a href="{{ route('jobseeker.profile.edit') }}" class="btn btn-outline-primary btn-sm">Edit</a>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>Change Password</span>
                    <a href="{{ route('jobseeker.password.edit') }}" class="btn btn-outline-danger btn-sm">Change</a>
                </li>
            </ul>
        </div>
    </div>
</div>
@endsection
