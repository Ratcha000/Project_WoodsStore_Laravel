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
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id('Cusor_ID');
            $table->unsignedBigInteger('Customer_id'); // FK -> customers
            $table->string('Product_Name'); 
            $table->unsignedBigInteger('Stock_ID'); // FK -> stocks
            $table->unsignedBigInteger('SSN_Passport'); // FK -> carpenters
            $table->float('Cus_Width');
            $table->float('Cus_Height');
            $table->float('Cus_Thickness');
            $table->integer('Cus_Quantity');
            $table->integer('Used_Stock_Quantity'); // ✅ เพิ่มฟิลด์นี้
            $table->decimal('Cus_Price', 10, 2);
            $table->text('Cus_Design')->nullable();
            $table->enum('Cus_Status', ['Pending', 'In Progress', 'Completed', 'Cancelled', 'Archived'])->default('Pending');

            $table->timestamps();
            
            $table->foreign('Customer_id')->references('Customer_id')->on('customers')->onDelete('cascade');
            
            $table->foreign('SSN_Passport')->references('SSN_Passport')->on('carpenters')->onDelete('cascade');

           
            $table->foreign('Stock_ID')->references('SID')->on('stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_orders');
    }
};
