<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function login(Request $request)
    {
        // dd($request);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        $credentials = $request->only('email', 'password');
        // dd(Auth::guard('admin')->attempt($credentials));
        if (Auth::guard('admin')->attempt($credentials)) {
            // Authentication passed...
            return redirect('/admin/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials'])->withInput();
    }
    public function dashboard(Request $request)
    {
        $locations = Location::all();

        $query = JobSeeker::query()->with('location');

        if ($request->filled('name')) {
            $query->where('name', 'like', "%{$request->name}%");
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', "%{$request->email}%");
        }
        if ($request->filled('min_exp')) {
            $query->where('experience', '>=', $request->min_exp);
        }
        if ($request->filled('max_exp')) {
            $query->where('experience', '<=', $request->max_exp);
        }
        if ($request->filled('skills')) {
            $query->where('skills', 'like', "%{$request->skills}%");
        }
        if ($request->filled('location_id')) {
            $query->where('location_id', $request->location_id); // direct comparison
        }


        $jobSeekers = $query->get();

        return view('admin.dashboard', compact('jobSeekers', 'locations'));
    }

    public function showJobSeeker($id)
    {
        $jobSeeker = JobSeeker::with('location')->findOrFail($id);
        return view('admin.job_seeker_view', compact('jobSeeker',));
    }

    public function getPhoto($filename)
    {
        $path = 'public/photos/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'Photo not found');
        }

        $fileContent = Storage::get($path);
        $mime = Storage::mimeType($path);

        return response($fileContent)->header('Content-Type', $mime);
    }

    public function downloadResume($filename)
    {
        $path = 'private/resumes/' . $filename;

        if (!Storage::exists($path)) {
            abort(404, 'Resume not found');
        }
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        $customName = 'Resume.' . $extension;


        return Storage::download($path, $customName);
    }



    public function deleteJobSeeker($id)
    {
        $jobSeeker = JobSeeker::findOrFail($id);

        if ($jobSeeker->photo && file_exists(public_path('uploads/photos/' . $jobSeeker->photo))) {
            unlink(public_path('uploads/photos/' . $jobSeeker->photo));
        }

        if ($jobSeeker->resume && file_exists(public_path('uploads/resumes/' . $jobSeeker->resume))) {
            unlink(public_path('uploads/resumes/' . $jobSeeker->resume));
        }

        $jobSeeker->delete();

        return redirect()->back()->with('success', 'Job Seeker soft-deleted successfully.');
    }


    public function logoutAdmin(Request $request)
{
    Auth::guard('admin')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // return redirect('/login/admin')->with('status', 'Admin successfully logged out!');
    return redirect()->route('home');
}
}
