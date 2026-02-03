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
        Schema::create('customers', function (Blueprint $table) {
            $table->id('Customer_id'); // Primary Key
            $table->string('Customer_name'); 
            $table->string('Customer_email')->unique();
            $table->string('Customer_phone')->nullable();
            $table->text('Customer_address')->nullable();

           
            $table->enum('Customer_type', ['regular', 'wholesale', 'vip'])->default('regular');

           
            $table->enum('Status', ['active', 'inactive', 'banned'])->default('active');

            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
