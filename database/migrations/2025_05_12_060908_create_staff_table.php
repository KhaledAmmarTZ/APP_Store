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
        Schema::create('staff', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('department')->nullable();
            $table->string('position')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('staff_nid')->unique()->nullable();
            $table->string('staff_image')->nullable();
            $table->string('status')->default('active');
            $table->string('gender')->nullable();
            $table->string('emergency_contact')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('spouse_name')->nullable();
            $table->enum('role' , ['manager', 'staff'])->default('staff');
            $table->enum('work_type', ['full_time', 'part_time'])->default('full_time');
            $table->date('joining_date')->nullable();
            $table->string('bank_account_number')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('password')->nullable(); // Password will be set after confirmation
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
