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
        Schema::create('bill_details', function (Blueprint $table) {
            $table->id('BillDetail_ID');
            $table->unsignedBigInteger('Bill_ID');
            $table->unsignedBigInteger('PID');
            $table->integer('Quantity');
            $table->decimal('Price', 10, 2);
            $table->decimal('Total_price', 10, 2);
            $table->timestamps();

            $table->foreign('Bill_ID')->references('Bill_ID')->on('bills')->onDelete('cascade');
            $table->foreign('PID')->references('PID')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_details');
    }
};
