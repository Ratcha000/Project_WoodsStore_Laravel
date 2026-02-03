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
        Schema::create('bills', function (Blueprint $table) {
            $table->id('Bill_ID'); 
            $table->unsignedBigInteger('Order_ID');
            $table->unsignedBigInteger('Customer_id');
            $table->decimal('Total_price', 10, 2);
            $table->decimal('VAT', 10, 2)->default(0.00);
            $table->decimal('Grand_total', 10, 2);
            $table->string('Payment_status', 20)->default('pending');
            $table->timestamps();

            $table->foreign('Order_ID')->references('Order_ID')->on('orders')->onDelete('cascade');
            $table->foreign('Customer_id')->references('Customer_id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
