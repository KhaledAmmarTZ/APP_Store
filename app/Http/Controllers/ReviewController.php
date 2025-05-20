<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
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
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        $user = auth()->user(); // Get the logged-in user

        // Check if the user already reviewed this product
        $review = Review::where('user_id', $user->id)
                        ->where('product_id', $request->product_id)
                        ->first();

        if ($review) {
            // Update the existing review
            $review->update([
                'rating' => $request->rating,
                'comment' => $request->comment,
                'review_date' => now(),
            ]);
        } else {
            // Create a new review
            Review::create([
                'user_id' => $user->id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'review_date' => now(),
            ]);
        }

        // Recalculate total reviews and average rating
        $product = \App\Models\Product::find($request->product_id);
        $totalReviews = $product->reviews()->count();
        $totalRating = $totalReviews;
        $averageRating = $totalReviews > 0 ? round($product->reviews()->avg('rating'), 2) : 0;

        $product->update([
            'total_review' => $totalReviews,
            'total_rating' => $totalRating,
            'average_rating' => $averageRating,
        ]);

        return back()->with('success', 'Review submitted successfully!');
    }


    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
    }
}
