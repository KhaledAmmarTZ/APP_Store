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
    public function store(Request $request): RedirectResponse|View
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = $request->email;
        $password = $request->password;

        $matchedRoles = [];

        $user = User::where('email', $email)->first();
        if ($user && Hash::check($password, $user->password)) {
            $matchedRoles[] = 'user';
        }

        $staff = Staff::where('email', $email)->first();
        if ($staff && Hash::check($password, $staff->password)) {
            $matchedRoles[] = 'staff';
        }

        $vendor = Vendor::where('email', $email)->first();
        if ($vendor && Hash::check($password, $vendor->password)) {
            if ($vendor->status === 'approved') {
                $matchedRoles[] = 'vendor';
            }
        }

        // If multiple matches, show role selection
        if (count($matchedRoles) > 1) {
            return view('auth.choose-role', [
                'roles' => $matchedRoles,
                'email' => $email,
                'password' => $password,
            ]);
        }

        // Single match - proceed
        if (in_array('user', $matchedRoles)) {
            Auth::guard('web')->login($user);
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        if (in_array('staff', $matchedRoles)) {
            Auth::guard('staff')->login($staff);
            $request->session()->regenerate();
            return redirect()->intended('/staff/dashboard');
        }

        if (in_array('vendor', $matchedRoles)) {
            Auth::guard('vendor')->login($vendor);
            $request->session()->regenerate();
            return redirect()->intended('/vendor/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    /**
     * Handle login after role selection.
     */
    public function roleLogin(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:user,staff,vendor',
        ]);

        $email = $request->email;
        $password = $request->password;
        $role = $request->role;

        switch ($role) {
            case 'user':
                $user = User::where('email', $email)->first();
                if ($user && Hash::check($password, $user->password)) {
                    Auth::guard('web')->login($user);
                    $request->session()->regenerate();
                    return redirect()->intended('/dashboard');
                }
                break;

            case 'staff':
                $staff = Staff::where('email', $email)->first();
                if ($staff && Hash::check($password, $staff->password)) {
                    Auth::guard('staff')->login($staff);
                    $request->session()->regenerate();
                    return redirect()->intended('/staff/dashboard');
                }
                break;

            case 'vendor':
                $vendor = Vendor::where('email', $email)->first();
                if ($vendor && Hash::check($password, $vendor->password) && $vendor->status === 'approved') {
                    Auth::guard('vendor')->login($vendor);
                    $request->session()->regenerate();
                    return redirect()->intended('/vendor/dashboard');
                }
                break;
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials for selected role.']);
    }

    /**
     * Logout from current session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
