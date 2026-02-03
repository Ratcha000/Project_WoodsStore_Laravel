<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logins', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->string('email')->unique(); // อีเมลที่ใช้ล็อกอิน
            $table->string('password'); // รหัสผ่าน
            $table->timestamp('last_login_at')->nullable(); // เวลาที่ล็อกอินล่าสุด
            $table->timestamps(); // เวลาเพิ่มและแก้ไขข้อมูล
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logins');
    }
};
