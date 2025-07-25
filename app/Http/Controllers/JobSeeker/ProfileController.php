<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use App\Models\JobSeeker;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        $jobseeker = Auth::guard('jobseeker')->user();
        $locations = Location::all();
        // return view('jobseeker.profile.edit', compact('jobseeker'));
        return view('jobseeker.profile.edit', compact('jobseeker', 'locations'));
    }

    public function update(Request $request)
    {
        // $jobseeker = Auth::guard('jobseeker')->user();
        $jobseeker = JobSeeker::find(Auth::guard('jobseeker')->id());

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'experience' => 'nullable|numeric|min:0',
            'notice_period' => 'nullable|numeric|min:0',
            'skills' => 'required|string|max:1000',
            'location_id' => 'required|exists:locations,id',
            'photo' => 'required|image|mimes:jpg,jpeg,png',
            'resume' => 'required|mimes:pdf,docx',
        ]);
        // dd($validatedData);

        // Handle Profile Image
        if ($request->hasFile('photo')) {
            $imageName = time() . '_profile.' . $request->photo->extension();
            $request->photo->move(public_path('photo'), $imageName);
            $validatedData['photo'] = 'photo/' . $imageName;
        }

        // Handle Resume
        if ($request->hasFile('resume')) {
            $resumeName = time() . '_resume.' . $request->resume->extension();
            $request->resume->move(public_path('resume'), $resumeName);
            $validatedData['resume'] = 'resume/' . $resumeName;
        }

        // Update the jobseeker
        $jobseeker->update($validatedData);

        return redirect()->back()->with('success', 'Profile updated successfully!');
    }
}
