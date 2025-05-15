<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreVendorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Vendor $vendor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vendor $vendor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateVendorRequest $request, Vendor $vendor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vendor $vendor)
    {
        //
    }

    public function showRegistrationForm()
    {
        return view('vendor.register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:vendors,email',
            'company_name' => 'nullable|string|max:255',
        ]);

        Vendor::create([
            'name' => $request->name,
            'email' => $request->email,
            'company_name' => $request->company_name,
            'status' => 'pending', // Default status is pending
        ]);

        return redirect()->route('vendor.register.form')->with('success', 'Registration submitted. Please wait for admin approval.');
    }

    public function listVendors()
    {
        $vendors = Vendor::where('status', 'pending')->get();
        return view('admin.vendors.index', compact('vendors'));
    }

    public function approveVendor(Vendor $vendor)
    {
        $vendor->update(['status' => 'approved']);

        // Send email to vendor with password setup link
        Mail::to($vendor->email)->send(new \App\Mail\VendorApproved($vendor));

        return redirect()->route('admin.vendors')->with('success', 'Vendor approved successfully.');
    }

    public function declineVendor(Vendor $vendor)
    {
        $vendor->update(['status' => 'declined']);
        return redirect()->route('admin.vendors')->with('success', 'Vendor declined successfully.');
    }

    // Show the password setup form
    public function showPasswordSetupForm(Request $request)
    {
        $vendor = Vendor::where('email', $request->query('email'))->first();

        if (!$vendor || $vendor->status !== 'approved') {
            return redirect('/')->withErrors(['email' => 'Invalid or unapproved vendor.']);
        }

        return view('vendor.password-setup', compact('vendor'));
    }

    // Handle password setup
    public function setupPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:vendors,email',
            'password' => 'required|confirmed|min:8',
        ]);

        $vendor = Vendor::where('email', $request->email)->first();

        if (!$vendor || $vendor->status !== 'approved') {
            return redirect('/')->withErrors(['email' => 'Invalid or unapproved vendor.']);
        }

        $vendor->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('vendor.register.form')->with('success', 'Password set successfully. You can now log in.');
    }
}
