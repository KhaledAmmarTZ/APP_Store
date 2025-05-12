<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    protected $table = 'staff';

    protected $fillable = [
        'name',
        'email',
        'role',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public $timestamps = true;
}
