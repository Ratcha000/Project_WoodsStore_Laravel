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
            $table->id('PID'); 
            $table->unsignedBigInteger('SID')->nullable(); 
            $table->unsignedBigInteger('Cusor_ID')->nullable(); 
            $table->string('P_Name'); 
            $table->decimal('Price', 10, 2); 
            $table->decimal('P_Width', 8, 2); 
            $table->decimal('P_Height', 8, 2);
            $table->decimal('P_Thickness', 8, 2); 
            $table->integer('P_Quantity');
            $table->enum('P_Status', ['Available', 'Out of Stock', 'Discontinued'])->default('Available');
            $table->timestamps();
            $table->softDeletes(); 
            
            $table->foreign('SID')->references('SID')->on('stocks')->onDelete('set null');
            $table->foreign('Cusor_ID')->references('Cusor_ID')->on('custom_orders')->onDelete('set null'); // ✅ เพิ่ม FK เชื่อมกับ custom_orders
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
