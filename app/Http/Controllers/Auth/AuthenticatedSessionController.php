<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        if (Auth::guard('admin')->check()) {
            Auth::guard('admin')->logout();
            $redirectPath = '/login/admin';
        } elseif (Auth::guard('jobseeker')->check()) {
            Auth::guard('jobseeker')->logout();
            $redirectPath = '/login/jobseeker';
        } else {
            Auth::guard('web')->logout();
            $redirectPath = route('home'); // fallback
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->to($redirectPath);
    }
}
