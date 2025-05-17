<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false; // Because the primary key is a string
    protected $keyType = 'string';

    protected $fillable = [
        'product_name',
        'product_description',
        'product_image',
        'product_price',
        'product_discount',
        'version',
        'size_in_mb',
        'platform',
        'type',
        'release_date',
        'status',
        'created_by',
        'total_sold',
        'total_rating',
        'total_stock',
        'total_review',
        'average_rating',
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
