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
        Schema::create('product_app_backups', function (Blueprint $table) {
            $table->id();
            $table->string('product_id', 15);
            $table->string('app_file');
            $table->string('version');
            $table->timestamp('backed_up_at')->useCurrent();
            $table->timestamps();

            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_app_backups');
    }
};
