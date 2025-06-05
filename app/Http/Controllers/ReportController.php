<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class ReportController extends Controller
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
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'reason' => 'nullable|string|max:1000',
        ]);

        $userId = Auth::id();
        $productId = $request->input('product_id');

        // Prevent duplicate report within 1 day
        $recentReport = Report::where('user_id', $userId)
            ->where('product_id', $productId)
            ->where('reported_at', '>=', Carbon::now()->subDay())
            ->first();

        if ($recentReport) {
            return back()->with('error', 'You have already reported this product within the last 24 hours.');
        }

        Report::create([
            'user_id' => $userId,
            'product_id' => $productId,
            'reason' => $request->input('reason'),
            'reported_at' => now(),
        ]);

        return back()->with('success', 'Report submitted successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Report $report)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Report $report)
    {
        //
    }
}
