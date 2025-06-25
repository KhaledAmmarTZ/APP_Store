<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product_app_backups extends Model
{
    protected $fillable = [
        'product_id',
        'app_file',
        'version',
        'backed_up_at',
    ];
}
