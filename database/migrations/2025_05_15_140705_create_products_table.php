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
        Schema::create('products', function (Blueprint $table) {
            $table->string('id', 15)->primary();
            $table->string('product_name');
            $table->text('product_description')->nullable();
            $table->string('product_image');
            $table->decimal('product_price', 10, 2); // Original price
            $table->decimal('discount_percent', 5, 2)->default(0); // Discount in percent
            $table->decimal('final_price', 10, 2)->default(0); // Final price after discount

            $table->string('version');
            $table->decimal('size_in_mb', 8, 2)->nullable(); // 
            $table->enum('platform', ['android', 'ios', 'web'])->default('web');
            $table->enum('type', ['free', 'paid'])->default('free');
            
            // Foreign key to category table
            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');

            $table->date('release_date');
            $table->enum('status', ['active', 'inactive', 'suspended','pending'])->default('pending');
            // Foreign key to (vendor) table
            $table->string('created_by', 20); 
            $table->foreign('created_by')->references('id')->on('vendors')->onDelete('cascade');

            $table->decimal('total_sold', 10, 2)->default(0)->unsigned()->nullable();
            $table->decimal('total_rating', 10, 2)->default(0)->unsigned()->nullable();
            $table->decimal('total_stock', 10, 2)->default(0)->unsigned()->nullable();
            $table->decimal('total_review', 10, 2)->default(0)->unsigned()->nullable();
            $table->decimal('average_rating', 3, 2)->default(0)->unsigned()->nullable();

            $table->date('last_updated')->nullable();
            $table->text('update_patch')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
