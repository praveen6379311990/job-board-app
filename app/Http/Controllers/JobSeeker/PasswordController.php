<?php

namespace App\Http\Controllers\JobSeeker;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function edit()
    {
        return view('jobseeker.password.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'password' => 'required|confirmed|min:6',
        ]);

        $jobseeker = Auth::guard('jobseeker')->user();

        if (!Hash::check($request->old_password, $jobseeker->password)) {
            return back()->withErrors(['old_password' => 'Old password is incorrect']);
        }

        $jobseeker->password = Hash::make($request->password);
        $jobseeker->save();

        return redirect()->back()->with('success', 'Password updated successfully!');
    }

}
