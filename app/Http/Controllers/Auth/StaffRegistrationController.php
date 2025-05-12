<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StaffRegistrationController extends Controller
{
    /**
     * Confirm the staff's email and allow them to set a password.
     */
    public function confirm(Request $request)
    {
        // Find the staff by email
        $staff = Staff::where('email', $request->email)->firstOrFail();

        // Check if the email is already verified
        if ($staff->email_verified_at) {
            return redirect()->route('login')->with('info', 'Email already confirmed.');
        }

        // Mark the email as verified
        $staff->update([
            'email_verified_at' => now(),
        ]);

        // Redirect to a password setup page
        return redirect()->route('staff.password.setup', ['email' => $staff->email]);
    }

    /**
     * Show the password setup form.
     */
    public function showPasswordSetupForm(Request $request)
    {
        return view('auth.staff-password-setup', ['email' => $request->email]);
    }

    /**
     * Handle the password setup.
     */
    public function setupPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:staff,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $staff = Staff::where('email', $request->email)->firstOrFail();

        $staff->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Password set successfully. You can now log in.');
    }
}
