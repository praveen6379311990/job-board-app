<?php

namespace App\Http\Controllers;

use App\Models\JobSeeker;
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
        $query = JobSeeker::query();

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
        if ($request->filled('job_location')) {
            $query->where('job_location', 'like', "%{$request->job_location}%");
        }

        $jobSeekers = $query->get();

        return view('admin.dashboard', compact('jobSeekers'));
    }

    public function showJobSeeker($id)
    {
        $jobSeeker = JobSeeker::findOrFail($id);
        return view('admin.job_seeker_view', compact('jobSeeker'));
    }

    public function getPhoto($filename)
    {
        $path = 'private/photos/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        return response()->file(storage_path('app/' . $path));
    }

    public function downloadResume($filename)
    {
        $path = 'private/resumes/' . $filename;

        if (!Storage::exists($path)) {
            abort(404);
        }

        return Storage::download($path);
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



    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect('/login/admin');
    }
}
