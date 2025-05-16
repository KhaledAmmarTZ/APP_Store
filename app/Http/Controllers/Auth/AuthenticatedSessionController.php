<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Staff;
use App\Models\Vendor;

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
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        // logging in as User
        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            Auth::guard('web')->login($user);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        // logging in as Staff
        $staff = Staff::where('email', $email)->first();
        if ($staff && Hash::check($password, $staff->password)) {
            Auth::guard('staff')->login($staff);
            $request->session()->regenerate();
            return redirect()->intended('/staff/dashboard');
        }

        // logging in as Vendor
        $vendor = Vendor::where('email', $email)->first();
        if ($vendor && Hash::check($password, $vendor->password)) {
            if ($vendor->status !== 'approved') {
                return back()->withErrors(['email' => 'Your vendor account is not approved yet.']);
            }
            Auth::guard('vendor')->login($vendor);
            $request->session()->regenerate();
            return redirect()->intended('/vendor/dashboard');
        }

        // no match
        return back()->withErrors([
            'email' => 'Invalid credentials.',
        ]);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
