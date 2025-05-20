<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'comment',
        'review_date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($review) {
            self::updateProductStats($review->product_id);
        });

        static::deleted(function ($review) {
            self::updateProductStats($review->product_id);
        });
    }

    protected static function updateProductStats($productId)
    {
        $reviews = self::where('product_id', $productId)->get();

        $totalRating = $reviews->sum('rating');
        $totalReview = $reviews->count();
        $averageRating = $totalReview > 0 ? round($totalRating / $totalReview, 2) : 0;

        Product::where('id', $productId)->update([
            'total_rating' => $totalRating,
            'total_review' => $totalReview,
            'average_rating' => $averageRating,
        ]);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
