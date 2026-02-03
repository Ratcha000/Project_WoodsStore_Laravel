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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('Order_ID'); // Primary Key
            $table->unsignedBigInteger('Customer_id'); // FK ไปยัง customers
            $table->dateTime('Order_date')->default(now());
            $table->decimal('Total_price', 10, 2)->default(0.00);
            $table->enum('Status', ['pending', 'completed', 'cancelled'])->default('pending');
            $table->timestamps();
        
            // Foreign Key
            $table->foreign('Customer_id')->references('Customer_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
