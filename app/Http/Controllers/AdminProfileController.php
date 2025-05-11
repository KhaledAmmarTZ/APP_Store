<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminProfileController extends Controller
{
    /**
     * Show the admin's profile edit form.
     */
    public function edit(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        return view('admin.profile.edit', compact('admin'));
    }

    /**
     * Update the admin's profile.
     */
    public function update(AdminProfileUpdateRequest $request)
    {
        $admin = Auth::guard('admin')->user();
        $validatedData = $request->validated();

        if ($request->hasFile('admin_image')) {
            if ($admin->admin_image && Storage::disk('public')->exists($admin->admin_image)) {
                Storage::disk('public')->delete($admin->admin_image);
            }

            $validatedData['admin_image'] = $request->file('admin_image')->store('admin_images', 'public');
        }

        $admin->update($validatedData);

        return redirect()->route('admin.profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the admin's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('adminDeletion', [
            'password' => ['required', 'current_password:admin'],
        ]);

        $admin = Auth::guard('admin')->user();

        if (!$admin) {
            return redirect()->back()->withErrors(['error' => 'Admin not found.']);
        }

        if ($admin->admin_image && Storage::disk('public')->exists($admin->admin_image)) {
            Storage::disk('public')->delete($admin->admin_image);
        }

        Auth::guard('admin')->logout();

        $admin->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}