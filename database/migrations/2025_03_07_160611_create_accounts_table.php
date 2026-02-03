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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id('Ac_id'); // Primary Key

            // ✅ FK ไปยัง Cost
            $table->unsignedBigInteger('Cost_ID')->nullable(); // ให้ nullable()
            $table->foreign('Cost_ID')->references('Cost_ID')->on('costs')->onDelete('set null');
            

            // ✅ FK ไปยัง Bill
            $table->unsignedBigInteger('Bill_ID')->nullable();
            $table->foreign('Bill_ID')->references('Bill_ID')->on('bills')->onDelete('set null');

            // ข้อมูลรายรับ รายจ่าย
            $table->decimal('income', 10, 2)->nullable(); // รายรับ
            $table->decimal('expense', 10, 2)->nullable(); // รายจ่าย
            $table->decimal('tax_cal', 10, 2)->nullable(); // คำนวณภาษี (ถ้ามี)
            $table->date('Ac_date'); 

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
