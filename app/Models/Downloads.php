<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Downloads extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'downloaded_at',
    ];

    function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
