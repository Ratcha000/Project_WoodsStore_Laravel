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
        Schema::create('costs', function (Blueprint $table) {
            $table->id('Cost_ID');  // หรือ $table->unsignedBigInteger('Cost_ID');


            // ประเภทค่าใช้จ่าย: wood, carpenter_salary, electricity, water, fuel, other
            $table->string('Cost_Type'); 

            // วันที่เกิดค่าใช้จ่าย
            $table->date('Expense_Date');

            // รายละเอียดเพิ่มเติม
            $table->string('Description')->nullable(); 

            // เชื่อมโยงกับช่างไม้ (ถ้าเป็นค่าแรง)
            $table->unsignedBigInteger('Carpenter_ID')->nullable();
            $table->foreign('Carpenter_ID')->references('SSN_Passport')->on('carpenters')->onDelete('set null');

            // เชื่อมโยงกับไม้ (ถ้าเป็นค่าใช้จ่ายเกี่ยวกับไม้)
            $table->unsignedBigInteger('Wood_ID')->nullable();
            $table->foreign('Wood_ID')->references('WID')->on('woods')->onDelete('set null');

            // จำนวน (ใช้กับ Wood หรือ Carpenter เช่น ชั่วโมงการทำงาน)
            $table->integer('Quantity')->nullable(); 

            // ราคาต่อหน่วย
            $table->decimal('Unit_Cost', 10, 2)->nullable(); 

            // ยอดรวมของค่าใช้จ่าย
            $table->decimal('Total_Cost', 10, 2); 

            // หมายเลขอ้างอิง (ใช้กับใบเสร็จหรือ Invoice)
            $table->string('Reference_No')->nullable(); 

            // สร้าง timestamps
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('costs');
    }
};
