<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class StaffProfileController extends Controller
{
    public function edit()
    {
        return view('staff.profile.edit');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:staff,email,' . Auth::guard('staff')->id(),
        ]);

        $staff = Auth::guard('staff')->user();
        $staff->update($request->only('name', 'email'));

        return redirect()->route('staff.profile.edit')->with('success', 'Profile updated successfully.');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password' => 'required|confirmed|min:8',
        ]);

        $staff = Auth::guard('staff')->user();

        if (!Hash::check($request->current_password, $staff->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        $staff->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('staff.profile.edit')->with('success', 'Password updated successfully.');
    }

    public function showUpdatePasswordForm()
    {
        return view('staff.profile.update-password');
    }
}
