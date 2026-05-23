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
        $table->id();
        
        // الاسم (String)
        $table->string('name');
        
        $table->string('slug')->unique(); 
        

        $table->foreignId('category_id')->constrained()->cascadeOnDelete();

        $table->text('description')->nullable();
        
        // السعر (Decimal) - أفضل من float عشان الدقة في الحسابات المالية
        // 10 أرقام منهم 2 بعد العلامة العشرية
        $table->decimal('price', 10, 2)->default(0);
        
        // الكمية (Integer)
        $table->integer('stock')->default(0);

        // صورة المنتج
        $table->string('image')->nullable();
        
        // الحالة (هل المنتج متاح للبيع ولا لأ؟)
        $table->boolean('is_active')->default(true);
        $table->boolean('is_visible')->default(true); // عشان يتحكم في ظهور المنتج
        $table->timestamps();
        
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
