<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Category extends Model
{
    protected $fillable = [
        'category_name',
        'category_description',
    ];

    /**
     * Relationship: Category belongs to many products
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class);
    }
}
