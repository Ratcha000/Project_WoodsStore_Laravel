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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id('DID'); // Primary Key
            $table->unsignedBigInteger('Order_ID'); // FK ไปยัง orders
            $table->unsignedBigInteger('Customer_id')->nullable(); // FK ไปยัง customers (ถ้าลูกค้าเลือกเอง)
            $table->string('D_type', 50); // ประเภทของการขนส่ง
            $table->decimal('D_price', 10, 2)->default(0.00); // ค่าขนส่งพื้นฐาน
            $table->decimal('distance_km', 8, 2)->default(0.00); // ระยะทางขนส่ง (กิโลเมตร)
            $table->decimal('extra_cost', 10, 2)->default(0.00); // ค่าขนส่งเพิ่มเติมตามระยะทาง
            $table->enum('Delivery_status', ['pending', 'shipped', 'delivered', 'cancelled'])->default('pending'); // สถานะของการขนส่ง
            $table->dateTime('Delivery_date')->nullable(); // วันที่ขนส่ง
            $table->string('Tracking_number', 100)->nullable(); // หมายเลขติดตามพัสดุ
            $table->timestamps();
        
            // Foreign Keys
            $table->foreign('Order_ID')->references('Order_ID')->on('orders')->onDelete('cascade');
            $table->foreign('Customer_id')->references('Customer_id')->on('customers')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
