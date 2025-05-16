<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model implements AuthenticatableContract
{
    use HasFactory, Authenticatable;

    protected $table = 'staff';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'department',
        'position',
        'date_of_birth',
        'staff_nid',
        'staff_image',
        'status',
        'gender',
        'emergency_contact',
        'father_name',
        'mother_name',
        'spouse_name',
        'role',
        'work_type',
        'joining_date',
        'bank_account_number',
        'bank_name',
        'password',
        'email_verified_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'date_of_birth' => 'date',
        'joining_date' => 'date',
    ];

    public $timestamps = true;
}
