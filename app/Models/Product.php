<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false; 
    protected $keyType = 'string';

    protected $casts = [
        'product_price' => 'float',
        'discount_percent' => 'float',
        'final_price' => 'float',
        'size_in_mb' => 'float',
        'average_rating' => 'float',
    ];

    protected $fillable = [
        'product_name',
        'main_title',
        'short_title',
        'product_description',
        'product_price',
        'discount_percent',    
        'final_price',         
        'version',
        'size_in_mb',
        'platform',
        'type',
        'release_date',
        'status',
        'created_by',
        'checked_by',
        'total_sold',
        'total_rating',
        'total_stock',
        'total_review',
        'average_rating',
        'is_featured',
        'is_free',
        'last_updated',
        'update_patch',
    ];

    /**
     * Relationship: Product belongs to many categories
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * Relationship: Product belongs to a vendor (creator)
     */
    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Vendor::class, 'created_by', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                do {
                    $id = \Illuminate\Support\Str::random(15);
                } while (static::where('id', $id)->exists());

                $model->id = $id;
            }
        });
    }
}
