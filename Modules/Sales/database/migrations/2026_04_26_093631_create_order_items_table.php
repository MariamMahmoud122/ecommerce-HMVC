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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        // ربط بالأوردر (موجود في نفس الموديول)
        $table->foreignId('order_id')->constrained()->onDelete('cascade');

        // ربط بالمنتج (موجود في موديول الكتالوج)
        $table->unsignedBigInteger('product_id'); 
        
        $table->integer('quantity')->default(1);
        $table->decimal('price', 10, 2); 
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
