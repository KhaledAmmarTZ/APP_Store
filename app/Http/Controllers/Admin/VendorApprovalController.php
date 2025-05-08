<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class VendorApprovalController extends Controller
{
    public function index()
    {
        $pendingVendors = User::where('role', 'pending_vendor')->get();
        return view('admin.vendor-requests', compact('pendingVendors'));
    }

    public function approve(User $user)
    {
        $user->update(['role' => 'vendor']);
        return redirect()->route('admin.vendor.requests')->with('success', 'Vendor approved successfully.');
    }

    public function reject(User $user)
    {
        $user->update(['role' => 'customer']);
        return redirect()->route('admin.vendor.requests')->with('success', 'Vendor request rejected.');
    }
}