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
        Schema::create('carpenters', function (Blueprint $table) {
            $table->id('SSN_Passport'); 
            $table->unsignedBigInteger('SID')->nullable(); 
            $table->string('Fname');
            $table->string('Lname');
            $table->string('Tel')->nullable();
            $table->integer('Age')->nullable();
            $table->text('Address')->nullable();
            $table->string('Salary_Type')->nullable();
            $table->decimal('Salary_Amount', 10, 2)->nullable();
            $table->string('Payment_Method')->nullable();
            $table->decimal('Bonus', 10, 2)->nullable();
            $table->text('Benefits')->nullable();
            $table->timestamps();

            
            $table->foreign('SID')->references('SID')->on('salaries')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carpenters');
    }
};
