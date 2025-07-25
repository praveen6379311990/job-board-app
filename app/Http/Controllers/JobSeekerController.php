<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobSeekerController extends Controller
{
    public function showRegisterForm()
    {
        $locations = Location::all();
        return view('jobseeker.register', compact('locations'));
    }

    public function register(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:job_seekers',
            'phone' => 'required',
            'experience' => 'required|integer',
            'notice_period' => 'required|integer',
            'skills' => 'required',
            'location_id' => 'required',
            'resume' => 'nullable|mimes:pdf,docx',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png',
            'password' => 'required|confirmed|min:6',
        ]);

        $resumePath = $request->file('resume')?->store('resumes');
        $photoPath = $request->file('photo')?->store('photos');

        JobSeeker::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'experience' => $request->experience,
            'notice_period' => $request->notice_period,
            'skills' => $request->skills,
            'location_id' => $request->location_id,
            'resume' => $resumePath,
            'photo' => $photoPath,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login/jobseeker')->with('success', 'Registered successfully');
    }

    public function showLoginForm()
    {
        return view('jobseeker.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->only('email', 'password');
        if (Auth::guard('jobseeker')->attempt($credentials)) {
            return redirect('/jobseeker/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials']);
    }
}
