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
        Schema::create('stocks', function (Blueprint $table) {
            $table->id('SID');
            $table->unsignedBigInteger('WID'); 
            $table->string('S_Name');
            $table->decimal('S_Width', 8, 2); 
            $table->decimal('S_Height', 8, 2); 
            $table->decimal('S_Thickness', 8, 2);
            $table->integer('Stock_quantity');
            $table->string('S_Status')->nullable();
            $table->timestamps();
            $table->softDeletes(); 
            

            
            $table->foreign('WID')->references('WID')->on('woods')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
