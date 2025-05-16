<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->string('id', 20)->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('role')->default('vendor');
            $table->string('company_name')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('company_address')->nullable();
            $table->string('business_license')->nullable();
            $table->string('vendor_nid')->unique()->nullable();
            $table->string('vendor_image')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('password')->nullable(); // Password will be set after approval
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('status', ['pending', 'approved', 'declined' , 'suspended'])->default('pending'); // Approval status
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vendors');
    }
};
