<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorRequestController extends Controller
{
    public function create()
    {
        return view('vendor.request');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        // Update the user's role to 'pending_vendor'
        $user->update(['role' => 'pending_vendor']);

        return redirect()->route('dashboard')->with('success', 'Your request to become a vendor has been submitted.');
    }
}