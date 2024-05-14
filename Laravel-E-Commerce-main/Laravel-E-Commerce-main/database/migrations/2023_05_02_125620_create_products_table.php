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
            $table->id();
            $table->string('title');
            $table->string('image');
            $table->string('category_name');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('brand_name');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade');
            $table->string('quantity');
            $table->string('price');
            $table->string('discount_price');
            // $table->string('screen_size');
            // $table->string('screen_resolution');
            // $table->string('screen_refresh_rate');
            // $table->string('device_weight');
            // $table->string('graphics_type');
            // $table->string('graphics_card_memory');
            // $table->string('ssd_capacity');
            // $table->string('operating_system');
            // $table->string('processor');
            // $table->string('processor_generation');
            // $table->string('processor_type');
            // $table->string('processor_speed');
            // $table->string('ram');
            // $table->string('keyboard');
            $table->string('color');
            $table->enum('status',[0,1]);
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
