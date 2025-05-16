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
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

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

    // Custom ID generation
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $last = self::orderBy('id', 'desc')->first();
                $number = 1;
                if ($last) {
                    $lastNumber = (int)str_replace('staff.', '', $last->id);
                    $number = $lastNumber + 1;
                }
                $model->id = 'staff.' . str_pad($number, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
