<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model implements AuthenticatableContract
{
    /** @use HasFactory<\Database\Factories\VendorFactory> */
    use HasFactory, Authenticatable;

    protected $table = 'vendors';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'company_name',
        'phone',
        'address',
        'company_address',
        'business_license',
        'vendor_nid',
        'vendor_image',
        'bank_account_number',
        'bank_name',
        'password',
        'email_verified_at',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public $timestamps = true;

    // Custom ID generation for vendor like vendor.0000000001
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $last = self::orderBy('id', 'desc')->first();
                $number = 1;
                if ($last) {
                    $lastNumber = (int)str_replace('vendor.', '', $last->id);
                    $number = $lastNumber + 1;
                }
                $model->id = 'vendor.' . str_pad($number, 5, '0', STR_PAD_LEFT);
            }
        });
    }
}
