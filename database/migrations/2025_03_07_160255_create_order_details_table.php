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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id('OrderDetail_ID'); // Primary Key
            $table->unsignedBigInteger('Order_ID'); // FK ไปยัง orders
            $table->unsignedBigInteger('PID'); // FK ไปยัง products
            $table->integer('Quantity')->default(1);
            $table->decimal('Price', 10, 2); // ราคาต่อชิ้น
            $table->timestamps();
        
            // Foreign Keys
            $table->foreign('Order_ID')->references('Order_ID')->on('orders')->onDelete('cascade');
            $table->foreign('PID')->references('PID')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
